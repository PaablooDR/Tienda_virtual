<!--Vista del admin a todo lo que puede hacer en categorias-->

<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>

        <div id="adminContent">
            <h1 id="titleAdmin">Categories</h1>

            <a href="index.php?controller=Category&action=new"><button>New Category</button></a>
            <input type="text" id="search" placeholder="Search">
            <div class="fullScreen">
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
                                <div><a href='index.php?controller=Category&action=edit&code=<?php echo $category['code']; ?>'>
                                    <div><img src='sources/web/edit.png' style='width: 50px;'></div>
                                </a></div>
                            </div>
            <?php
                        }
            ?>
                        <input type='submit' name='desactivate' id="changeActive" value='Change active'>
                    </div>
                </form>
            </div>
        </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/searchBar.js"></script>