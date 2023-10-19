<?php
if ($alert) { ?>
    <?php if ($type == 'warning') { ?>
        <div class="d-flex justify-content-center pt-3">
            <div class="alert alert-warning alert-dismissible fade show  w-25" role="alert">
                <strong><?php echo $alert_title ?></strong></strong> <?php echo $alert_message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>


    <?php  } ?>

    <?php if ($type == 'danger') { ?>
        <div class="d-flex justify-content-center pt-3">
            <div class="alert alert-danger alert-dismissible fade show  w-25" role="alert">
                <strong><?php echo $alert_title ?></strong></strong> <?php echo $alert_message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

    <?php  } ?>

    <?php if ($type == 'success') { ?>
        <div class="d-flex justify-content-center pt-3">
            <div class="alert alert-success alert-dismissible fade show  w-25" role="alert">
                <strong><?php echo $alert_title ?></strong></strong> <?php echo $alert_message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

    <?php  } ?>


<?php } ?>