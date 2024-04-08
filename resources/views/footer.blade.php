<div class="row">
                             <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Task management system.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>


    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();

        // Show pop-up form when Add button is clicked
        $('#addButton').click(function() {
            $('#popupForm').fadeIn();
        });

        // Hide pop-up form when Submit button is clicked
        $('#submitButton').click(function() {
            $('#popupForm').fadeOut();
            // Add code here to handle form submission
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Show pop-up form when Add button is clicked
        $('#addButton').click(function () {
            $('#popupForm').fadeIn();
        });

        // Hide pop-up form when close button is clicked
        $('.close-btn').click(function () {
            $('#popupForm').fadeOut();
        });
    });
</script>

    <!-- Jquery JS-->
    
    <script src="admin/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="admin/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="admin/vendor/slick/slick.min.js">
    </script>
    <script src="admin/vendor/wow/wow.min.js"></script>
    <script src="admin/vendor/animsition/animsition.min.js"></script>
    <script src="admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="admin/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="admin/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="admin/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="admin/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="admin/vendor/select2/select2.min.js">
    </script>


    <!-- Main JS-->
    <script src="admin/js/main.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

</body>

</html>
<!-- end document-->