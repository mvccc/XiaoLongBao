<div class="container">
    <div class="row well">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>AWANA</h1>
            </div>

            <?php
                # Load Awana Menu.
                $data['lang'] = $lang;
                $this->load->view('/awana/awana_menu', $data);
            ?>

            <h2>Various AWANA Related Forms</h2>
            <hr>
            <table class="table table-striped table-hover">
                <thead><tr><th>Form</th><th>Download</th></tr></thead>
                <tbody>
                    <tr>
                        <td>Registration Form and MEDICAL and LIABILITIES RELEASE FORM</td>
                        <td>
                            <a href="<?php echo base_url(); ?>assets/doc/MVCCC_Awana_reg_form_2020.docx">
                                <img width="50px" height="50px" src="<?php echo base_url(); ?>/assets/img/wordicon.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>LIT (Leader In Training) Agreement</td>
                        <td>
                            <a href="<?php echo base_url(); ?>assets/doc/MVCCC_LIT_agreement_2020.doc">
                                <img width="50px" height="50px" src="<?php echo base_url(); ?>/assets/img/wordicon.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>LIT (Leader In Training) Application</td>
                        <td>
                            <a href="<?php echo base_url(); ?>assets/doc/LIT_application_2020.doc">
                                <img width="50px" height="50px" src="<?php echo base_url(); ?>/assets/img/wordicon.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Redeemable for One (1) AWANA Share</td>
                        <td>
                            <a href="<?php echo base_url(); ?>assets/doc/Awana_Redeemable.doc">
                                <img width="50px" height="50px" src="<?php echo base_url(); ?>/assets/img/wordicon.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>AWANA Handbook</td>
                        <td>
                            <a href="<?php echo base_url(); ?>assets/doc/Awana_Handbook.pdf">
                                <img width="50px" height="50px" src="<?php echo base_url(); ?>/assets/img/pdficon.gif">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
