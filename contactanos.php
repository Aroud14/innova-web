<?php include("includes/plantilla_inicio.php"); ?>

<?php include("includes/header.php"); ?>

<section class="section breadcrumb-modern context-dark parallax-container" data-parallax-img="images/parallax-03.jpg">
    <div class="parallax-content section-30 section-sm-70">
        <div class="shell">
            <h2 class="veil reveal-sm-block">Contactanos</h2>
            <div class="offset-sm-top-35">
                <ul class="list-inline list-inline-lg list-inline-dashed p">
                    <li><a href="index.php">Inicio</a></li>
                    <li>Contactanos</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section novi-background bg-cover section-70 section-md-114 bg-default">
    <div class="shell">
        <div class="range range-65 range-xs-center">
            <div class="cell-md-8 text-md-left">
                <h2 class="text-bold">Ponte en contacto con nosotros</h2>
                <hr class="divider bg-madison hr-md-left-0">
                <div class="offset-top-30 offset-md-top-30">
                    <p>
                        Puede contactarnos de cualquier forma que le resulte conveniente. Estamos disponibles las 24 horas, los 7 días de la semana, por teléfono, whatsapp o correo electrónico. También puede utilizar el formulario de contacto rápido a continuación o visitarnos personalmente. Estaremos encantados de responder a tus preguntas.
                    </p>
                </div>
                <div class="offset-top-30">
                    <form class="rd-mailform text-left form_guardar" id="form_contacto" method="post" action="php/subir.php">
                        <div class="range range-12">
                            <div class="cell-sm-6">
                                <div class="form-group">
                                    <label class="form-label form-label-outside" for="contact-me-name">Nombre</label>
                                    <input class="form-control form-validation-inside" id="contact-me-name" type="text" name="nombre" data-constraints="@Required">
                                </div>
                            </div>
                            <div class="cell-sm-6">
                                <div class="form-group">
                                    <label class="form-label form-label-outside" for="contact-me-last-name">Apellidos</label>
                                    <input class="form-control form-validation-inside" id="contact-me-last-name" type="text" name="apellidos" data-constraints="@Required">
                                </div>
                            </div>
                            <div class="cell-sm-6">
                                <div class="form-group">
                                    <label class="form-label form-label-outside" for="contact-me-email">E-mail</label>
                                    <input class="form-control form-validation-inside" id="contact-me-email" type="email" name="email" data-constraints="@Required @Email">
                                </div>
                            </div>
                            <div class="cell-sm-6">
                                <div class="form-group">
                                    <label class="form-label form-label-outside" for="contact-me-phone">Teléfono</label>
                                    <input class="form-control form-validation-inside" id="contact-me-phone" type="text" name="telefono" data-constraints="@Required @IsNumeric">
                                </div>
                            </div>
                            <div class="cell-xs-12">
                                <div class="form-group">
                                    <label class="form-label form-label-outside" for="contact-me-message">Mensaje</label>
                                    <textarea class="form-control form-validation-inside" id="contact-me-message" name="mensaje" data-constraints="@Required" style="height: 220
                                    px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-md-left offset-top-20">
                            <input type="hidden" name="opcion" id="opcion" value="1">
                            <button class="btn btn-primary" id="btn_guardar" type="submit">Enviar mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="cell-xs-10 cell-md-4 text-left">
                <aside class="aside inset-md-left-30">
                    <div class="aside-item-2">
                        <h6 class="text-bold">Teléfono</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <ul class="list list-unstyled">
                                <li><span class="icon novi-icon icon-xs text-madison mdi mdi-phone text-middle"></span><a class="text-middle inset-left-10 text-dark" target="_blank" href="tel:<?= $datosEmpresa["telefono"] ?>"><?= $datosEmpresa["telefono"] ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="aside-item-2">
                        <h6 class="text-bold">Whatsapp</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <ul class="list list-unstyled">
                                <li>
                                    <span class="icon novi-icon icon-xs text-madison mdi mdi-whatsapp text-middle"></span>
                                    <a class="text-middle inset-left-10 text-dark" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $datosEmpresa['whatsapp'] ?>&text=Hola,%20¿Me%20podria%20dar%20mas%20imformación?"><?= $datosEmpresa["whatsapp"] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="aside-item-2">
                        <h6 class="text-bold">E-mail</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <ul class="list list-unstyled">
                                <li>
                                    <span class="icon novi-icon icon-xs text-madison mdi mdi-email-outline text-middle"></span>
                                    <a class="text-primary text-middle inset-left-10" target="_blank" href="mailto:<?= $datosEmpresa["correo"] ?>"><?= $datosEmpresa["correo"] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="aside-item-2">
                        <h6 class="text-bold">Dirección</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <div class="unit unit-horizontal unit-spacing-xs">
                                <div class="unit-left"><span class="icon novi-icon icon-xs mdi mdi-map-marker text-madison"></span></div>
                                <div class="unit-body">
                                    <p><?= $datosEmpresa["direccion"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aside-item-2">
                        <h6 class="text-bold">Horarios de atención</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <div class="unit unit-horizontal unit-spacing-xs">
                                <div class="unit-left">
                                    <span class="icon novi-icon icon-xs mdi mdi-calendar-clock text-madison"></span>
                                </div>
                                <div class="unit-body">
                                    <div>
                                        <p><?= $datosEmpresa["horario_dias_info"] ?></p>
                                    </div>
                                    <div>
                                        <p><?= $datosEmpresa["horario_horas_info"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aside-item-2">
                        <h6 class="text-bold">Redes sociales</h6>
                        <div class="hr bg-gray-light offset-top-10"></div>
                        <ul class="list-inline list-inline-xs list-inline-madison">
                            <?= $datosEmpresa["instagram"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-instagram icon-circle icon-gray-light-filled" target="_blank" href="'.$datosEmpresa["instagram"].'"></a></li>' : ''  ?>

                            <?= $datosEmpresa["facebook"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-facebook icon-circle icon-gray-light-filled" target="_blank" href="'.$datosEmpresa["facebook"].'"></a></li>' : ''  ?>

                            <?= $datosEmpresa["whatsapp"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-whatsapp icon-circle icon-gray-light-filled" target="_blank" href="https://api.whatsapp.com/send?phone='.$datosEmpresa['whatsapp'].'&text=Hola,%20¿Me%20podria%20dar%20mas%20imformación?"></a></li>' : ''  ?>
                            
                            <?= $datosEmpresa["correo"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-send icon-circle icon-gray-light-filled" target="_blank" href="mailto:'.$datosEmpresa["correo"].'"></a></li>' : ''  ?>
                            
                            <?= $datosEmpresa["telefono"] != "" ? '<li><a class="icon novi-icon icon-xxs fa-phone icon-circle icon-gray-light-filled" target="_blank" href="tel:'.$datosEmpresa["telefono"].'"></a></li>' : ''  ?>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="google-map-container" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-styles="[{&quot;featureType&quot;:&quot;administrative&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:&quot;-100&quot;}]},{&quot;featureType&quot;:&quot;administrative.province&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;landscape&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:65},{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:&quot;50&quot;},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;road&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:&quot;-100&quot;}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;road.arterial&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;lightness&quot;:&quot;30&quot;}]},{&quot;featureType&quot;:&quot;road.local&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;lightness&quot;:&quot;40&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;hue&quot;:&quot;#ffff00&quot;},{&quot;lightness&quot;:-25},{&quot;saturation&quot;:-97}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;elementType&quot;:&quot;labels&quot;,&quot;stylers&quot;:[{&quot;lightness&quot;:-25},{&quot;saturation&quot;:-100}]}]" data-key="AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8" data-zoom="16">
        <div class="google-map"></div>
        <ul class="google-map-markers">
            <li data-location="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-description="9870 St Vincent Place, Glasgow" data-icon="images/gmap_marker.png" data-icon-active="images/gmap_marker_active.png"></li>
        </ul>
    </div>
</section>

<?php include("includes/footer.php"); ?>

<?php include("includes/plantilla_fin.php"); ?>
