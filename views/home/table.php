<?php

$contacts = $_POST["contacts"];

?>

<table>
    <thead>
        <tr class="flex">
            <th class="center">#</th>
            <th class="center">Contact</th>
            <th class="center">Lastname</th>
            <th class="center">Created</th>
        </tr>
    </thead>

    <tbody class="card">
        <?php

        foreach ($contacts as $contact){
        
        ?>
        <tr class="flex">
            <td class="center"><?php echo $contact["id"]; ?></td>
            <td class="center"><?php echo $contact["contact_no"]; ?></td>
            <td class="center"><?php echo $contact["lastname"]; ?></td>
            <td class="center"><?php echo $contact["createdtime"]; ?></td>
        </tr>
        <?php
        
        }
        
        ?>
    </tbody>
</table>