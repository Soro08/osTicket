<?php
//
// Calling conventions
// $q - <CustomQueue> object for this navigation entry
// $selected - <bool> true if this queue is currently active
// $child_selected - <bool> true if the selected queue is a descendent
global $cfg;
$childs = $children;
$this_queue = $q;
$selected = (!isset($_REQUEST['a'])  && $_REQUEST['queue'] == $this_queue->getId());
?>
<li class="top-queue item <?php if ($child_selected) echo 'child active';
    elseif ($selected) echo 'active'; ?>">
  <a href="<?php echo $this_queue->getHref(); ?>"
    class="Ticket"><?php echo $this_queue->getName(); ?>
<?php if (!$cfg->showTopLevelTicketCounts()) { ?>
    <span id="queue-count-bucket">
      (<span class="queue-count"
        data-queue-id="<?php echo $this_queue->id; ?>">
      </span>)
    </span>
<?php } ?>
  </a>

</li>