<div id="containerAdmin">
<?php
        require_once("views/admin/sidebar.php");
?>
    <div id="invisibleSidebar"></div>
    <div id="adminContent">
        <h1 id="titleAdmin">Signature</h1>
        <canvas id="signatureCanvas" width="400" height="200" style="border:1px solid #000;"></canvas><br>
        <button id="saveSignature">Save</button>
        <button id="eraserPencil">Eraser</button>
        <button id="cleanSignature">Clean</button>
    </div>
</div>
<script src="js/signature.js"></script>