<?php
if (!isConnect('admin')) {
    throw new Exception('{{Error 401 Unauthorized}}');
}
sendVarToJS('eqType', 'vmc');
$eqLogics = eqLogic::byType('vmc');
?>
<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter une VMC}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
foreach ($eqLogics as $eqLogic) {
    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
    echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '" style="' . $opacity . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
           </ul>
       </div>
   </div>

   <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
    <legend>{{Mes VMC}}
    </legend>
    <div class="eqLogicThumbnailContainer">
      <div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
       <center>
        <i class="fa fa-plus-circle" style="font-size : 7em;color:#94ca02;"></i>
    </center>
    <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02"><center>Ajouter</center></span>
</div>
<?php
foreach ($eqLogics as $eqLogic) {
    $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
    echo "<center>";
    echo '<img src="plugins/vmc/doc/images/vmc_icon.png" height="105" width="95" />';
    echo "</center>";
    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
    echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
    <div class="row">
        <div class="col-sm-6">
            <form class="form-horizontal">
                <fieldset>
                    <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}
                        <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i>
                    </legend>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{Nom de la VMC}}</label>
                        <div class="col-sm-6">
                            <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                            <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de la VMC}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >{{Objet parent}}</label>
                        <div class="col-sm-6">
                            <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                                <option value="">{{Aucun}}</option>
                                <?php
foreach (object::all() as $object) {
    echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
                           </select>
                       </div>
                   </div>

                   <div class="form-group">
                    <label class="col-sm-4 control-label">{{Activer}}</label>
                    <div class="col-sm-8">
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
    <div class="col-sm-6">
        <form class="form-horizontal">
            <fieldset>
                <legend>{{Configuration}}
                    <a class="btn btn-xs btn-default pull-right eqLogicAction" data-action="copy"><i class="fa fa-files-o"></i> {{Dupliquer}}</a>
                </legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Type}}</label>
                    <div class="col-sm-6">
                        <select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="type" placeholder="" >
                            <option value="df">Double Flux</option>
                            <option value="sf" disabled>Simple flux</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Rendement de l'échangeur (%)}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="rendement_theorique" title="{{Précisez le rendement théorique de l'échangeur de la VMC (donnée constructeur) en %. Exemple: 90}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Débit d'air nominal (m3/h)}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="debit_nominal" title="{{Précisez le débit d'air nominal de la VMC}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Débit d'air mode Boost (m3/h)}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="debit_boost" title="{{Précisez le débit d'air en mode Boost (surventilation) de la VMC}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Débit d'air mode absent (m3/h)}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="debit_absent" title="{{Précisez le débit d'air en mode Absent (surventilation) de la VMC}}"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

    <hr/>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#configureFonctionnement" data-toggle="tab">{{Modes de fonctionnement}}</a></li>
        <li><a href="#configureSondes" data-toggle="tab">{{Configuration des Sondes}}</a></li>
        <li><a href="#configureActions" data-toggle="tab">{{Configuration des Actions}}</a></li>
        <li><a href="#configurePuitCanadien" data-toggle="tab">{{Puit canadien}}</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="configureFonctionnement">
            <br/>
            <div class="alert alert-info">
                {{Indiquer ici si Jeedom contrôle les fonctions. Si c'est votre VMC qui contrôle une fonction automatiquement, alors ne pas activer l'option ici.}}
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Contrôle du By-Pass}}</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}"  data-l1key="configuration" data-l2key="controle_bypass"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Contrôle du mode Boost}}</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}"  data-l1key="configuration" data-l2key="controle_boost"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Contrôle du mode Absent}}</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}"  data-l1key="configuration" data-l2key="controle_absent"/>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="configureSondes">
            <br/>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Etat du mode Boost}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="etat_boost" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Etat du mode absence}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="etat_absence" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Etat du By-pass}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="etat_bypass" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Air neuf exterieur aspiré}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="temperature_airneufexterieur" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Air neuf insuflé}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="temperature_airneufinsuflé" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Air vicié aspiré}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="temperature_airvicie" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Air vicié rejeté}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="temperature_airvicierejete" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="configureActions">
            <br/>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour activer le mode Boost}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_activer_boost" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour désactiver le mode Boost}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_desctiver_boost" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour activer le mode Absence}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_activer_absence" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour désactiver le mode Absence}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_desactiver_absence" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour activer le By-pass}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_activer_bypass" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour désactiver le By-pass}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_desctiver_bypass" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="configurePuitCanadien">
            <br/>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Puit canadien}}</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}"  data-l1key="configuration" data-l2key="etat_pc"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Air entrée puit canadien}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="temperature_entree_pc" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Etat du By-pass du puit canadien}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="etat_bypass_pc" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdInfo"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour activer le By-Pass vers le puit canadien}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_activer_bypass_pc" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{Pour désactiver le By-Pass vers le puit canadien}}</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="action_desactiver_bypass_pc" data-concat="1"/>
                            <span class="input-group-btn">
                                <a class="btn btn-default listCmdAction"><i class="fa fa-list-alt"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<hr/>
<form class="form-horizontal">
    <fieldset>
        <div class="form-actions">
            <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
            <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
        </div>
    </fieldset>
</form>
</div>
</div>

<?php include_file('desktop', 'vmc', 'js', 'vmc');?>
<?php include_file('core', 'plugin.template', 'js');?>
