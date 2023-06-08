

<script type='text/javascript'>
    let data = <?php echo json_encode($get); ?>;
    console.log(data);
    window.Print.postMessage(data);
</script>

