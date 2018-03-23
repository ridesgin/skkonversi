<!DOCTYPE html>
<html>
    <head>
        <title>Contoh AJAX 3 - AJAX Post</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script>
            $().ready(function(){
                $('#FormInput').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        'type': 'POST',
                        'url': 'jjl2.php',
                        'data': $(this).serialize(),
                        'success': function(html){
                            $('#container').html(html);
                        }
                    });
                });
            });
        </script>
        <style>
            form > div{
                border-bottom: 1px solid #eee;
                margin-bottom: 10px;
            }
            form label{
                display: block;
            }
        </style>
    </head>
    <body>
        <h2>Form Registrasi</h2>
 
        <div id="container">
            <form id="FormInput">
                <div>
                    <label>Nama:</label>
                    <input name="nama" />
                </div>
                <div>
                    <label>Alamat:</label>
                    <input name="alamat" />
                </div>
                <div>
                    <label>E-Mail:</label>
                    <input name="email" />
                </div>
                <div>
                    <label>Jenis Kelamin:</label>
                    <select name="jenis_kelamin">
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <input type="submit" />
            </form>
        </div>
    </body>
</html>