<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for("@api")?>" method="post">
  <table id="api_form" style="margin: 25px; padding: 10px;">
    <tfoot>
      <tr>
        <td colspan="2" align="right" style="margin: 0 50px;">
          <input type="submit" value=<?php echo __("get list")?> style="align: left;"/>
        </td>
      </tr>
    </tfoot>
    <tbody style= "padding: 5px;">
      <?php echo $form ?>
    </tbody>
  </table>
</form>