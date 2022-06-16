
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<table style="text-align:right">
<div class="bootstrap-iso">
<div class="container-fluid">
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="row">
    <div class="form-group ">
<label class="control-label">
      Date
      </label>
<input type="text" class="form-control" name="datepicker" id="datepicker" />
</div>
</div>
</div>
<div>
</div>
</table>
<script>
$("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});
</script>
