<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyuru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Duyuru</h1>

        <ul class="list-group mt-4">
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "abdullah";
            $dbname = "otomasyon";

            
            $conn = new mysqli($servername, $username, $password, $dbname);

            
            if ($conn->connect_error) {
                die("Veritabanına bağlanılamadı: " . $conn->connect_error);
            }

            
            $sql = "SELECT * FROM duyuru ORDER BY tarih DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item">' . $row['baslik'] . ' - ' . $row['metin'] . '<span class="float-right">';
                    echo '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal" data-id="' . $row['id'] . '" data-baslik="' . $row['baslik'] . '" data-metin="' . $row['metin'] . '">Düzenle</button>';
                    echo ' <button class="btn btn-sm btn-danger" onclick="deleteDuyuru(' . $row['id'] . ')">Sil</button>';
                    echo '</span></li>';
                }
            } else {
                echo '<li class="list-group-item">Duyuru bulunamadı.</li>';
            }

            $conn->close();
            ?>
        </ul>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Duyuru Düzenle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="form-group">
                                <label for="edit_baslik">Başlık:</label>
                                <input type="text" class="form-control" id="edit_baslik" name="edit_baslik" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_metin">Metin:</label>
                                <textarea class="form-control" id="edit_metin" name="edit_metin" rows="4" required></textarea>
                            </div>
                            <input type="hidden" id="edit_id" name="edit_id">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-container">
            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#addModal">Ekle</button>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Duyuru Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            <div class="form-group">
                                <label for="add_baslik">Başlık:</label>
                                <input type="text" class="form-control" id="add_baslik" name="add_baslik" required>
                            </div>
                            <div class="form-group">
                                <label for="add_metin">Metin:</label>
                                <textarea class="form-control" id="add_metin" name="add_metin" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        
        function deleteDuyuru(id) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu duyuruyu silmek istediğinizden emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet, Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $.ajax({
                        url: 'delete_duyuru.php',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Duyuru başarıyla silindi.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var baslik = button.data('baslik');
                var metin = button.data('metin');

                var modal = $(this);
                modal.find('#edit_id').val(id);
                modal.find('#edit_baslik').val(baslik);
                modal.find('#edit_metin').val(metin);
            });

            
            $('#editForm').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var id = form.find('#edit_id').val();
                var baslik = form.find('#edit_baslik').val();
                var metin = form.find('#edit_metin').val();

                
                $.ajax({
                    url: 'update_duyuru.php',
                    type: 'POST',
                    data: {
                        id: id,
                        baslik: baslik,
                        metin: metin
                    },
                    success: function(response) {
                        
                        Swal.fire({
                            title: 'Güncellendi!',
                            text: 'Duyuru başarıyla güncellendi.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            });

           
            $('#addForm').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var baslik = form.find('#add_baslik').val();
                var metin = form.find('#add_metin').val();

                
                $.ajax({
                    url: 'add_duyuru.php',
                    type: 'POST',
                    data: {
                        baslik: baslik,
                        metin: metin
                    },
                    success: function(response) {
                        
                        Swal.fire({
                            title: 'Eklendi!',
                            text: 'Duyuru başarıyla eklendi.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
