<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>
   

        <div id="adminContent">
            <div class="fullScreen">

                <form action="index.php?controller=Product&action=add" method="post" enctype="multipart/form-data">
                    <h1 id="titleAdmin">NEW PRODUCT</h1>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Name" maxlength="100" required><br>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50" placeholder="Description" required></textarea><br>

                    <label for="category">Category:</label>
                    <select id="category" name="category">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['code'] . "," . $category['name']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label for="photo">Photo:</label>
                    <input type="file" id="photo" name="photo" accept=".jpg, .png, .JPEG" required><br>

                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" placeholder="Price" pattern="\d+(\.\d{1,2})?" required><br>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" placeholder="Stock" required><br>

                    <label for="outstanding">Outstanding:</label>
                    <input type="checkbox" id="outstandingCheck" name="outstanding" value="outstanding"><br>

                    <input type="submit" name="send" id="changeActive" value="Enter">
                </form>
            </div>
        </div>
</div>
