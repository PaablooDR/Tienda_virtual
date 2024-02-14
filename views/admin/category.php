<!--Vista del admin a todo lo que puede hacer en categorias-->

<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>

        <div id="adminContent">
            <div class="fullScreen">
                <h1 id="titleAdmin">Categories</h1>

                <a href="index.php?controller=Category&action=new"><h3>New Category</h3></a>
                <input type="text" id="search">

                <form action='index.php?controller=Category&action=desactivate' method='post' enctype='multipart/form-data'>
                    <div id="bodyList">
                        <div class="list">
                            <div>Select all</div>
                            <div>Code</div>
                            <div>Name</div>
                            <div>Edit</div>
                        </div>    
            <?php
                        foreach ($categories as $category) {
            ?>
                            <div class="list">
                                <div> <input type='checkbox' name='selectedItems[]' value='<?php echo $category['code']; ?>'> </div>
                                <div><?php echo $category['code']; ?></div>
                                <div><?php echo $category['name']; ?></div>
                                <a href='index.php?controller=Category&action=edit&code=<?php echo $category['code']; ?>'>
                                    <div><img src='sources/web/edit.png' style='width: 50px;'></div>
                                </a>
                            </div>
            <?php
                        }
            ?>
                        <input type='submit' name='desactivate' value='Change active'>
                    </div>
                </form>
            </div>
        </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/searchBar.js"></script>