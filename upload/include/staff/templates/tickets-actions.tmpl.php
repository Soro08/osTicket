<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php
// Tickets mass actions based on logged in agent

// Status change
if ($agent->canManageTickets())
    echo TicketStatus::status_options();

// -----------------------====================================================-----------------------------//
// Change color by soro
// MODIFIER LE CODE AVEC VOS 
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "osticket";
$servername = DBHOST;
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    // =======--------------- CODE A MODIFIER --------=========== //
    $stmt = $conn->prepare("SELECT * FROM ost_colors");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
}
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }

if ($agent->hasPerm(Ticket::PERM_ASSIGN, false)) {?>

    <span
        class="action-button" data-placement="bottom"
        data-dropdown="#action-dropdown-colors" data-toggle="tooltip" title=" <?php
        echo __('Change color'); ?>">
        <i class="icon-caret-down pull-right"></i>
        <a class="tickets-action" id="tickets-colors"
            aria-label="<?php echo __('Change color'); ?>"
            href=""><i class="icon-adjust"></i></a>
    </span>
    <div id="action-dropdown-colors" class="action-dropdown anchor-right">
        <ul>
        <!-- Display colors -->
            <?php foreach($stmt->fetchAll() as $k=>$v) { ?>
                <li><a class="" onclick="dysplaycheck(<?php echo $v['id']; ?>);"> <?php echo $v['color']; ?></a> </li>
                
            <?php } ?>
        </ul>
    </div>
    <?php
    }

// End colors by Soro //
// -----------------------====================================================-----------------------------//
// Mass Claim/Assignment
if ($agent->hasPerm(Ticket::PERM_ASSIGN, false)) {?>
<span
    class="action-button" data-placement="bottom"
    data-dropdown="#action-dropdown-assign" data-toggle="tooltip" title=" <?php
    echo __('Assign'); ?>">
    <i class="icon-caret-down pull-right"></i>
    <a class="tickets-action" id="tickets-assign"
        aria-label="<?php echo __('Assign'); ?>"
        href="#tickets/mass/assign"><i class="icon-user"></i></a>
</span>
<div id="action-dropdown-assign" class="action-dropdown anchor-right">
  <ul>
     <li><a class="no-pjax tickets-action"
        href="#tickets/mass/claim"><i
        class="icon-chevron-sign-down"></i> <?php echo __('Claim'); ?></a>
     <li><a class="no-pjax tickets-action"
        href="#tickets/mass/assign/agents"><i
        class="icon-user"></i> <?php echo __('Agent'); ?></a>
     <li><a class="no-pjax tickets-action"
        href="#tickets/mass/assign/teams"><i
        class="icon-group"></i> <?php echo __('Team'); ?></a>
  </ul>
</div>
<?php
}

//Mass Merge
if ($agent->hasPerm(Ticket::PERM_MERGE, false)) {?>
<span class="button action-button">
 <a class="tickets-action" id="tickets-merge" data-placement="bottom"
    data-toggle="tooltip" title="<?php echo __('Merge'); ?>"
    href="#tickets/mass/merge"><i class="icon-code-fork"></i></a>
</span>
<?php
}

//Mass Link
if ($agent->hasPerm(Ticket::PERM_LINK, false)) {?>
<span class="button action-button">
 <a class="tickets-action" id="tickets-link" data-placement="bottom"
    data-toggle="tooltip" title="<?php echo __('Link'); ?>"
    href="#tickets/mass/link"><i class="icon-link"></i></a>
</span>
<?php
}

// Mass Transfer
if ($agent->hasPerm(Ticket::PERM_TRANSFER, false)) {?>
<span class="action-button">
 <a class="tickets-action" id="tickets-transfer" data-placement="bottom"
    data-toggle="tooltip" title="<?php echo __('Transfer'); ?>"
    href="#tickets/mass/transfer"><i class="icon-share"></i></a>
</span>
<?php
}


// Mass Delete
if ($agent->hasPerm(Ticket::PERM_DELETE, false)) {?>
<span class="red button action-button">
 <a class="tickets-action" id="tickets-delete" data-placement="bottom"
    data-toggle="tooltip" title="<?php echo __('Delete'); ?>"
    href="#tickets/mass/delete"><i class="icon-trash"></i></a>
</span>
<?php
}

?>
<script type="text/javascript">
$(function() {

    $(document).off('.tickets');
    $(document).on('click.tickets', 'a.tickets-action', function(e) {
        e.preventDefault();
        var $form = $('form#tickets');
        var count = checkbox_checker($form, 1);
        if (count) {
            var tids = $('.ckb:checked', $form).map(function() {
                    return this.value;
                }).get();
            var url = 'ajax.php/'
            +$(this).attr('href').substr(1)
            +'?count='+count
            +'&tids='+tids.join(',')
            +'&_uid='+new Date().getTime();
            $.dialog(url, [201], function (xhr) {
                $.pjax.reload('#pjax-container');
             });
        }
        return false;
    });


});
// -----------------------======================= AJAX CODE BY SORO =============================-----------------------------//
function dysplaycheck(colorsid){
    console.log(colorsid)
    var checkboxvalue = [];
    // var checkboxvalue = document.querySelector('.ckb:checked').value;
    $("input:checkbox:checked").each(function(){
        checkboxvalue.push($(this).val());
    });
    if (checkboxvalue.length == 0){
        toastr.error('Merci de choisir un ticket pour appliquer cette action.', 'Error!', {timeOut: 8000})
    }else{
        console.log(checkboxvalue)
        $.post("aaapostcolors.php/",
        {
            ticketid: checkboxvalue,
            colorsid: colorsid,
        },
        function(data, status){
            if(data){
                
                // alert("Data: " + data + "\nStatus: " + status);
                toastr.success("La couleur du ticket vient d'être mise à jour!", 'Succès',{timeOut: 8000})
                location.reload();
            }else{
                console.log($data)
            }
            
        });
    }
    

    
}
// -----------------------====================================================-----------------------------//
</script>
