<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Formulario de Producto</h2>
        <form id="producto-form">
            <div class="row">
                <div class="col">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" 
                    id="codigo" name="codigo">
                </div>
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" 
                    id="nombre" name="nombre">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="bodega">Bodega</label>
                    <select id="bodega" name="bodega" class="form-control">
                        <option value="">Seleccione una bodega</option>
                        <?php
                            require 'database.php';
                            $query = "SELECT id, nombre FROM bodega";
                            $result = $connection->query($query);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="sucursal">Sucursal</label>
                    <select id="sucursal" name="sucursal" class="form-control">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="moneda">Moneda</label>
                    <select id="moneda" name="moneda" class="form-control">
                        <option></option>
                        <?php
                            require 'database.php';
                            $query = "SELECT id, nombre FROM moneda";
                            $result = $connection->query($query);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Material del Producto</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="material" value="Plástico">Plástico</label>
                        <label><input type="checkbox" name="material" value="Metal">Metal</label>
                        <label><input type="checkbox" name="material" value="Madera">Madera</label>
                        <label><input type="checkbox" name="material" value="Vidrio">Vidrio</label>
                        <label><input type="checkbox" name="material" value="Textil">Textil</label>
                    </div>
                </div>
            </div>

            <div class="row" >
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>

            <div class="button-container">
                <button type="submit">Guardar Producto</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>