
<body>

    
    <table class='table table-striped table-dark'>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>tel</th>
        <th>mail</th>
        <th>year</th>
        <th>sex</th>
        <th>edit</th>

        </tr>
    <?php $num = count($result);?> 
    <?php for($i=0; $i < $num; $i++) { ?>
        <tr>
        <td><?= $result[$i]['id']?></td>
        <td><?= $result[$i]['name']?></td>
        <td><?= $result[$i]['tel']?></td>
        <td><?= $result[$i]['mail']?></td>
        <td><?= $result[$i]['year']?></td>
        <td><?= $result[$i]['sex']?></td>
        
        <td>

        <form action="edy" method="post">
        <input type="submit" name="btn_submit" class="btn btn-success" value="編集">
            <input type="hidden" name="id" value="<?php echo $result[$i]['id']; ?>">
            <input type="hidden" name="name" value="<?php echo $result[$i]['name']; ?>">
            <input type="hidden" name="tel" value="<?php echo $result[$i]['tel']; ?>">
            <input type="hidden" name="mail" value="<?php echo $result[$i]['mail']; ?>">
            <input type="hidden" name="year" value="<?php echo $result[$i]['year']; ?>">
            <input type="hidden" name="sex" value="<?php echo $result[$i]['sex']; ?>">
        </form>
        
        <a href="delete?message_id=<?php echo $result[$i]['id']; ?>">削除</a></p>
    
        </td>

        </tr>
    <?php } ?>
    </table>

    <div class ="btn-submit">
    <form action="download" method="get">
        <input type="submit" name="btn_download" value="ダウンロード" class="btn btn-success">
    </form> 
    <form action="login" method="get">
        <input type="submit" name="back" value="戻る" class="btn btn-success">
    </form> 
    </div>
    
</body>
</html>
