<meta charset="UTF-8">

<link rel="stylesheet" href="/common/js/jquery-ui/jquery-ui.css" />
<link rel="stylesheet" href="../css/wccw.css" type="text/css" />
<link rel="stylesheet" href="/common/datepicker/css/humanity.datepick.css">

<script src="/common/js/jquery.js"></script>
<script src="/common/js/jquery-ui/jquery-ui.js"></script>
<script src="/common/js/jquery.min.js"></script>
<script src="/common/js/collapsible.js"></script>
<script src="/common/js/custom_scripts.js"></script>
<script src="/common/datepicker/js/jquery.plugin.min.js"></script>
<script src="/common/datepicker/js/jquery.datepick.js"></script>

<script>
    $(function() {
        $('#new_date').datepick({
            minDate: 0,
            dateFormat: "DDDD M d, yyyy",
            autoSize: true
        });
    });
</script>

</head>

<body id='wccw'>

    <textarea id='multi999Picker' name='dates' style='width:100%'></textarea>
    <input type='text' name='new_date' id='new_date' size='26' />
    </div>

    <!-- END wccw_new_.php ++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- END wccw_main.php-->
    <!-- BEGIN D:\public_html\sickingfamily_beta\footer.inc +++++++++ -->
</body>

</html>