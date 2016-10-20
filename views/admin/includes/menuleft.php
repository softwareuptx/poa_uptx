<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">
                    <strong><?=User()->u_nombre?></strong>
                    <p><?=User()->perfil?></p>
                    <button type="button" class="btn btn-xs btn-<?=User()->periodo->class?> waves-effect waves-light">
                        <span class="btn-label" style="margin-right: 5px;">
                            Año <?=User()->periodo->p_anio?>
                        </span>
                        <?=User()->periodo->status?>
                    </button>
                    <hr style="margin-bottom: 0px !important">
                </li>
                <li>
                    <a href="<?=base_url('instituciones')?>" class="waves-effect <?=menu('instituciones')?>"><i class="fa fa-institution"></i> <span>Instituciones</span></a>
                </li>
                <li>
                <a href="<?=base_url('unidades')?>" class="waves-effect <?=menu('unidades')?>"><i class="fa fa-th-large"></i> <span>Unidades</span></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->