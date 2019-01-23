<?php /* Smarty version 2.6.22, created on 2019-01-23 13:32:05
         compiled from laboratory/chemlab_data_results.tpl */ ?>
<table width="100%" border="0">
    <tbody>
        <tr valign="top">
            <td>
                                <form method="post" <?php echo $this->_tpl_vars['sFormAction']; ?>
 onSubmit="return pruf(this)" name="datain" style="position: relative;">
                    <table>
                        <tbody>
                            <tr>

                                <td class="adm_item"><?php echo $this->_tpl_vars['LDCaseNr']; ?>
:</td>
                                <td class="adm_input"><?php echo $this->_tpl_vars['sPID']; ?>
</td>
                            </tr>
                            <tr>
                                <td class="adm_item"><?php echo $this->_tpl_vars['LDLastName']; ?>
, <?php echo $this->_tpl_vars['LDName']; ?>
:</td>
                                <td class="adm_input"><b><?php echo $this->_tpl_vars['sLastName']; ?>
, <?php echo $this->_tpl_vars['sName']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td class="adm_item"><?php echo $this->_tpl_vars['LDBday']; ?>
:</td>
                                <td class="adm_input"><b><?php echo $this->_tpl_vars['sBday']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td class="adm_item"><?php echo $this->_tpl_vars['LDJobIdNr']; ?>
:</td>
                                <td class="adm_input"><?php echo $this->_tpl_vars['sJobIdNr']; ?>
</td>
                            </tr>
                            <tr>
                                <td class="adm_item"><?php echo $this->_tpl_vars['LDExamDate']; ?>
:</td>
                                <td class="adm_input"><?php echo $this->_tpl_vars['sExamDate']; ?>
 <?php echo $this->_tpl_vars['sMiniCalendar']; ?>
</td>
                            </tr>
                        </tbody>
                    </table>

                    <table width="100%"  bgcolor=#ffdddd  class="table table-condensed">
                        <tbody>
                            
                            <?php if ($this->_tpl_vars['batchMismatch']): ?>
                            <tr>
                                <td colspan="2">

                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                          <b> Mismatch - </b> The file's batch number doesn't match patients batch number. Please try again.</span>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="2" style="color: white; background-color: lightgreen; font-weight: bold;"><?php echo $this->_tpl_vars['sParamGroup']; ?>
</td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <td colspan="1">

                                    <style>
                                       .a10_b {
                                            font-size: 14px;
                                       }
                                        input[type="text"]{ padding: 0 auto; line-height: 22px; font-size: 14px; }
                                    </style>


                                                                        <table   class="table table-condensed table-bordered" >
                                        <tbody>
                                                                                        <?php echo $this->_tpl_vars['sParameters']; ?>

                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['pbSave']; ?>
 <?php echo $this->_tpl_vars['pbAccept']; ?>
 <?php echo $this->_tpl_vars['pbReject']; ?>
</td>
                                <td align="right"><?php echo $this->_tpl_vars['pbShowReport']; ?>
 <?php echo $this->_tpl_vars['pbCancel']; ?>
</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php echo $this->_tpl_vars['sSaveParamHiddenInputs']; ?>

                </form>

                

                <div style="position: absolute; top:50%; right: 10%; ">

                     <?php echo $this->_tpl_vars['resultFormUpload']; ?>

                </div>


                                <form <?php echo $this->_tpl_vars['sFormAction']; ?>
 method=post onSubmit="return chkselect(this)" name="paramselect">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="3"><b><?php echo $this->_tpl_vars['LDSelectParamGroup']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->_tpl_vars['LDParamGroup']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['sParamGroupSelect']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['sSubmitSelect']; ?>
</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php echo $this->_tpl_vars['sSelectGroupHiddenInputs']; ?>

                </form>

            </td>
            <td width="20%">
                                <table class="submenu3_body">
                    <tbody>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDParamNoSee']; ?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDOnlyPair']; ?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDHow2Save']; ?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDWrongValueHow']; ?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDVal2Note']; ?>
</td>
                        </tr>
                        <tr>
                            <td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['LDImDone']; ?>
</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>