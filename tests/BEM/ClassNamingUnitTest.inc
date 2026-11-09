<?php
// Valid classes in inline HTML, no warnings.
?>
<div class="block"></div>
<div class="block-name"></div>
<div class="block__element"></div>
<div class="block__element-name"></div>
<div class="block--modifier"></div>
<div class="block--modifier-name"></div>
<div class="block__element--modifier"></div>
<div class="block block__element block--modifier"></div>
<div class='block-name'></div>
<?php
// Exceptions that are allowed, no warnings.
?>
<div class="container"></div>
<div class="btn-primary btn-secondary"></div>
<div class="icon-arrow-right"></div>
<?php
// Invalid classes in inline HTML, one warning per class. Warnings land on the first line of the HTML block.
?>
<div class="Block"></div>
<?php ?>
<div class="block_element"></div>
<?php ?>
<div class="Block block_element block__Element"></div>
<?php ?>
<div class="123block"></div>
<?php ?>
<div class="block__element__nested"></div>
<?php
// Hyphens alone are valid, because a block name may contain them.
?>
<div class="block-element-modifier"></div>
<?php
// A string directly after a class= string is checked, and other strings are ignored.
$valid   = 'class='.'block__element';
$ignored = 'Not_A_Class';
$invalid = 'class='.'Block_Name';
$markup  = '<div class="Block_Name">';
$comment = 'wp:Not_A_Class';
