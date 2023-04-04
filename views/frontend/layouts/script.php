<!-- Bootstrap core JavaScript-->
    <script src="./assets/js/jquery.js"></script>
    <script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./assets/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./assets/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./assets/admin/js/demo/chart-area-demo.js"></script>
    <script src="./assets/admin/js/demo/chart-pie-demo.js"></script>
    <script>
        $(document).ready(function () {
            $(".edit").click(function(){
                $id = $(this).data('id');
                $("#id").val($id);
                $expdate = $(this).data('expdate');
                $("#date").val($expdate);
                $description = $(this).data('description');
                $("#des").val($description);
                $qty = $(this).data('qty');
                $("#count").val($qty);
                $unitprice = $(this).data('unitprice');
                $("#price").val($unitprice);
                // console.log($id, $expdate, $description, $qty, $unitprice);     
            });

            $(".delete_id").click(function(){
                $id = $(this).data('id');
                $("#delete_id").val($id);
            })
        });
   </script>
</body>

</html>