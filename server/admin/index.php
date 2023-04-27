<?php
include 'header.php';


?>
<script>
    window.location.href = "check_new.php";
</script>
<!--Content-->
<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                    <div class="row justify-content-between mb-1">
                        <h3 class="col-9 card-title">Hospital Jaffna</h3>
                        <!-- <i class="fas fa-star col-1 fa-lg"></i> -->
                        <i class="far fa-star col fa-lg ms-4"></i>
                    </div>
                    <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                        No1,
                        Hospital
                        Road,
                        Jaffna</p>
                    <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;02122110010</p>
                    <div class="row">
                        <div class="col-6 Hospital-Facilities">
                            <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Normal Bed</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">ICU Bed</p>
                                </div>
                            </div>
                            <p style="margin-bottom: -25px; margin-top: 2px;">Blood</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-4">
                                    <p class="available">A+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">O+</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">B+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available" style="font-size: 11.5px;">AB+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">A-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">O-</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">B-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">AB-</p>
                                </div>
                            </div>

                            <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Small</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">Large</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <p style="margin-bottom: 0px;">Vaccine</p> <br />
                            <div class="row justify-content-start ms-1">
                                <p class="available">Oxford-Astrazeneca</p>
                                <p class="shortage">Pfizer-BioNTech</p>
                                <p class="available">Moderna</p>
                                <p class="available">Sinopharm</p>
                                <p class="shortage">Sputnik V</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success w-100 mt-4 me-2">Request</button>
                    <!-- <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;"><a href="#"
                            style="text-decoration: none; color: #aaa;">See
                            more..</a>
                    </p> -->
                </div>
            </div>
        </div>

        <!--Producer-->
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                    <div class="row justify-content-between mb-1">
                        <h3 class="col-10 card-title">Producer 1</h3>
                        <i class="fas fa-star col-1"></i>
                        <i class="far fa-star col-1"></i>
                    </div>
                    <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                        No1,
                        Producer 1
                        Road,
                        Jaffna</p>
                    <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;01101010101</p>

                    <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                    <div class="row justify-content-start ms-1">
                        <div class="col-6">
                            <p>Normal Bed</p>
                        </div>
                    </div>
                    <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                    <div class="row justify-content-start ms-1">
                        <div class="col-3">
                            <p>Small</p>
                        </div>
                        <div class="shortage col-3">
                            <p>Medium</p>
                        </div>
                        <div class="col-3">
                            <p>Large</p>
                        </div>
                    </div>


                    <button class="btn btn-success float-end me-2">Request</button>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                    <div class="row justify-content-between mb-1">
                        <h3 class="col-10 card-title">Hospital x</h3>
                        <i class="fas fa-star col-1"></i>
                        <i class="far fa-star col-1"></i>
                    </div>
                    <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                        No1,
                        Hospital
                        Road,
                        Jaffna</p>
                    <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;02122110010</p>
                    <div class="row">
                        <div class="col-6 Hospital-Facilities">
                            <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Normal Bed</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">ICU Bed</p>
                                </div>
                            </div>
                            <p style="margin-bottom: -25px; margin-top: 2px;">Blood</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-4">
                                    <p class="available">A+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">O+</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">B+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available" style="font-size: 11.5px;">AB+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">A-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">O-</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">B-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">AB-</p>
                                </div>
                            </div>

                            <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Small</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">Large</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <p style="margin-bottom: 0px;">Vaccine</p> <br />
                            <div class="row justify-content-start ms-1">
                                <p class="available">Oxford-Astrazeneca</p>
                                <p class="shortage">Pfizer-BioNTech</p>
                                <p class="available">Moderna</p>
                                <p class="available">Sinopharm</p>
                                <p class="shortage">Sputnik V</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;"><a href="#" style="text-decoration: none; color: #aaa;">See
                            more..</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                    <div class="row justify-content-between mb-1">
                        <h3 class="col-10 card-title">Hospital x</h3>
                        <i class="fas fa-star col-1"></i>
                        <i class="far fa-star col-1"></i>
                    </div>
                    <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;
                        No1,
                        Hospital
                        Road,
                        Jaffna</p>
                    <p class="m-2" style="font-size: 13px;"><i class="fas fa-phone"></i> &nbsp;02122110010</p>
                    <div class="row">
                        <div class="col-6 Hospital-Facilities">
                            <p style="margin-bottom: -25px; margin-top: 2px;">Bed</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Normal Bed</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">ICU Bed</p>
                                </div>
                            </div>
                            <p style="margin-bottom: -25px; margin-top: 2px;">Blood</p> <br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-4">
                                    <p class="available">A+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">O+</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">B+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available" style="font-size: 11.5px;">AB+</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">A-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">O-</p>
                                </div>
                                <div class="col-4">
                                    <p class="available">B-</p>
                                </div>
                                <div class="col-4">
                                    <p class="shortage">AB-</p>
                                </div>
                            </div>

                            <p style="margin-bottom:  -25px; margin-top: 2px;">Oxygen Cylinder </p><br />
                            <div class="row justify-content-start ms-1">
                                <div class="col-6">
                                    <p class="available">Small</p>
                                </div>
                                <div class="col-6">
                                    <p class="shortage">Large</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <p style="margin-bottom: 0px;">Vaccine</p> <br />
                            <div class="row justify-content-start ms-1">
                                <p class="available">Oxford-Astrazeneca</p>
                                <p class="shortage">Pfizer-BioNTech</p>
                                <p class="available">Moderna</p>
                                <p class="available">Sinopharm</p>
                                <p class="shortage">Sputnik V</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;"><a href="#" style="text-decoration: none; color: #aaa;">See
                            more..</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php' ?>