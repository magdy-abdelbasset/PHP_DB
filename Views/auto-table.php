<table class="auto-table">
    <?php
    if (!empty($data)) {
        $rows = 0;
        $columns = 1;
        $first = false;
        $array_f = [];
        foreach ($data as $k => $val) {

            if (!empty($val) && is_array($val)) {
                foreach ($val as $k => $v) {
                    if ($rows == 0) {
                        if ($columns == 1) {
                            echo '<tr>';
                        }
    ?>
                        <th><?php echo ($k); ?></th>
                        <?php
                        if ($columns == count($val)) {
                            echo '</tr>';
                            $columns = 1;
                            foreach ($val as  $k2 => $v2) {
                                if ($columns == 1) {
                                    echo '<tr>';
                                } ?>
                                <td><?php echo ($v2); ?></td>
                        <?php if ($columns == count($val)) {
                                    echo '</tr>';
                                }
                                $columns++;
                            }
                        }
                    } else {
                        if ($columns == 1) {
                            echo '<tr>';
                        } ?>
                        <td><?php echo ($v); ?></td>
    <?php if ($columns == count($val)) {
                            echo '</tr>';
                        }
                    }
                    $columns++;
                }
                $columns = 1;
            }


            $rows++;
        }
    }
    ?>

</table>
<?php

?>