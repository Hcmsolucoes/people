<script src="http://code.jquery.com/jquery-latest.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url('js/k.js') ?>"></script>

<button id="get">Pdf</button>
<a href="pdfservlet/filename.pdf">pdf</a>
<script>
	$("#get").on('click', function(e){
		e ? e.preventDefault() : false;
		app.post('<?php echo base_url().'test/soap' ?>', null, 'application/pdf');
	});
</script>