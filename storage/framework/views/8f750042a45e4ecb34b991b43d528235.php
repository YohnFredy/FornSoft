<div>

    <p class="text-sm ml-2 mr-1 text-primary">
        Acepto <span wire:click="policy" class="text-secondary hover:text-primary text-sm underline cursor-pointer">
            la Política de Términos y Condiciones de Compra
        </span>
    </p>

    <?php if (isset($component)) { $__componentOriginal8cc9d3143946b992b324617832699c5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cc9d3143946b992b324617832699c5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.index','data' => ['wire:model' => 'terms','dismissible' => false,'class' => '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'terms','dismissible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'class' => '']); ?>
        <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['class' => 'text-primary! pr-6','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-primary! pr-6','size' => 'lg']); ?>Política de Términos y Condiciones de Compra
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>

        <div class="text-sm text-ink">
            <h5 class="my-4 text-justify">Al realizar una compra en nuestra tienda en línea, el cliente acepta los
                siguientes
                términos y condiciones, aplicables a todos los productos, incluidos los productos naturales y otros
                ofrecidos en nuestro sitio web.</h5>

            <h5 class="font-semibold">1. Descripción de Productos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class="mt-2">Todos los productos disponibles en nuestra tienda están debidamente descritos,
                    incluyendo sus características, especificaciones, usos sugeridos y, en el caso de productos
                    naturales, cualquier contraindicaciones. Es responsabilidad del cliente revisar esta información
                    antes de completar la compra.</li>
                <li class=" mt-2">Los productos naturales no sustituyen un tratamiento médico. Recomendamos consultar
                    con un profesional de la salud antes de utilizar cualquier producto natural, especialmente si se
                    tiene una condición médica preexistente.</li>
            </ul>

            <h5 class="font-semibold mt-4">2. Política de Envío y Entrega</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Realizamos envíos a nivel nacional dentro de Colombia. El tiempo estimado de entrega
                    depende de la ubicación del cliente y será especificado durante el proceso de compra.</li>
                <li class=" mt-2">El cliente debe pagar el valor del producto al momento de realizar la compra en
                    nuestra tienda en línea. El valor del envío no está incluido en el pago inicial y deberá ser pagado
                    por el cliente al recibir el producto directamente al transportador ("Pago del envío contra
                    entrega").</li>
                <li class=" mt-2">Si el cliente no se encuentra disponible para recibir el pedido, el transportista
                    puede reprogramar la entrega o, en algunos casos, devolver el pedido a nuestra bodega. El cliente
                    deberá asumir cualquier costo adicional que esto conlleve.</li>
            </ul>
            <h5 class="font-semibold mt-2">3. Política de Devoluciones y Reembolsos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Se aceptarán devoluciones solo en caso de que el producto llegue en mal estado, esté
                    defectuoso o no corresponda con el pedido realizado. El cliente debe notificar cualquier
                    irregularidad en un plazo de 3 días hábiles posteriores a la recepción del producto.</li>
                <li class=" mt-2">Para proceder con una devolución, el producto debe estar sin uso, en su empaque
                    original y con todos los accesorios incluidos.</li>
                <li class=" mt-2">Una vez aprobada la devolución, el reembolso del valor pagado por el producto se
                    procesará en un plazo de 15 días hábiles. Los costos de envío no son reembolsables.</li>
            </ul>
            <h5 class="font-semibold mt-2">4. Política de Cancelación de Pedido</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Los pedidos pueden ser cancelados sin costo alguno siempre que el producto no haya
                    sido despachado. Si el producto ya ha sido enviado, el cliente deberá asumir los costos de
                    devolución.</li>
                <li class=" mt-2">Los productos personalizados o elaborados bajo pedido no pueden ser cancelados una
                    vez iniciada su producción.</li>

            </ul>
            <h5 class="font-semibold mt-2">5. Política de Privacidad y Protección de Datos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Los datos personales proporcionados durante el proceso de compra serán tratados de
                    acuerdo con la legislación vigente en Colombia (Ley 1581 de 2012). Utilizaremos la información solo
                    para procesar el pedido, realizar el envío y, con el consentimiento del cliente, enviar
                    comunicaciones promocionales.</li>
                <li class=" mt-2">Los datos del cliente no serán compartidos con terceros salvo en los casos necesarios
                    para completar el proceso de entrega o cuando la ley lo requiera.</li>
            </ul>
            <h5 class="font-semibold mt-2">6. Pago y Facturación</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">El cliente debe pagar el valor del producto al momento de realizar la compra a través
                    de los métodos de pago disponibles en nuestra tienda en línea.</li>
                <li class=" mt-2">El valor del envío no está incluido en el pago inicial y deberá ser abonado
                    directamente al transportador al momento de recibir el producto.</li>

            </ul>
            <h5 class="font-semibold mt-2">7. Responsabilidad del Cliente</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2 ">El cliente es responsable de utilizar los productos de manera adecuada y conforme a
                    las instrucciones proporcionadas.</li>
                <li class=" mt-2">En el caso de productos naturales, no nos hacemos responsables por cualquier efecto
                    adverso causado por el uso incorrecto o excesivo de los mismos. Se recomienda consultar a un
                    profesional antes de su uso, especialmente si se combinan con otros productos o tratamientos.</li>
            </ul>
            <h5 class="font-semibold mt-2">8. Exoneración de Responsabilidad</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">No seremos responsables de daños o pérdidas indirectas, incluyendo, pero no
                    limitándose a, reacciones adversas a los productos naturales, pérdida de ingresos, o cualquier otro
                    daño relacionado con el uso de los productos adquiridos en nuestra tienda.</li>
                <li class=" mt-2">La responsabilidad por cualquier producto defectuoso se limita al valor del producto
                    adquirido.</li>
            </ul>
            <h5 class="font-semibold mt-2">9. Jurisdicción y Ley Aplicable</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Estas políticas están regidas por las leyes colombianas. Cualquier disputa que surja
                    en relación con la compra de productos a través de nuestra tienda en línea será resuelta ante los
                    tribunales competentes de Colombia.</li>

            </ul>
            <h5 class="font-semibold mt-2">10. Política de Garantía</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Todos los productos vendidos en nuestra tienda tienen una garantía de [especifica la
                    duración de la garantía, si aplica], contada a partir de la fecha de recepción del producto. La
                    garantía cubre defectos de fabricación y fallas del producto.</li>
                <li class=" mt-2">Quedan excluidos de la garantía los productos que hayan sido alterados, modificados o
                    utilizados de manera incorrecta.</li>
                <li class=" mt-2">Para reclamar la garantía, el cliente debe proporcionar la factura de compra y
                    fotografías del defecto o problema, y deberá enviarnos el producto para su evaluación.</li>
            </ul>
            <h5 class="font-semibold mt-2">11. Limitación de Responsabilidad por Entregas</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Si bien haremos todos los esfuerzos posibles para asegurar que los productos lleguen
                    dentro del tiempo de entrega estimado, no nos hacemos responsables por retrasos ocasionados por
                    eventos fuera de nuestro control, como problemas logísticos con los transportistas, desastres
                    naturales, huelgas, o medidas gubernamentales.</li>
                <li class=" mt-2">En caso de que un pedido se retrase considerablemente, nos comprometemos a mantener
                    una comunicación continua con el cliente para informarle sobre el estado de su pedido.</li>
            </ul>
            <h5 class="font-semibold mt-2">12. Modificación de los Términos y Condiciones</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier
                    momento. Los cambios serán efectivos una vez publicados en nuestra página web.</li>
                <li class=" mt-2">El cliente será notificado sobre cambios significativos que puedan afectar su compra
                    actual o futura, a través de los medios de contacto proporcionados.</li>
            </ul>
            <h5 class="font-semibold mt-2">13. Disponibilidad de los Productos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Todos los productos en nuestra tienda están sujetos a disponibilidad. En el caso de
                    que un producto comprado no esté disponible por cualquier motivo (incluyendo falta de stock), nos
                    pondremos en contacto con el cliente para ofrecer una alternativa o realizar el reembolso completo
                    del monto pagado.</li>
                <li class=" mt-2">Nos reservamos el derecho de retirar o modificar cualquier producto de nuestro sitio
                    web sin previo aviso.</li>
            </ul>
            <h5 class="font-semibold mt-2">14. Promociones y Ofertas</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Las promociones, descuentos y ofertas están sujetas a términos específicos que serán
                    comunicados en el momento de su publicación. Estos términos pueden incluir restricciones en cuanto a
                    fechas, productos participantes, cantidades limitadas, etc.</li>
                <li class=" mt-2">Los cupones o códigos promocionales no son acumulables, a menos que se especifique lo
                    contrario. Cada promoción está sujeta a un uso por cliente.</li>
            </ul>
            <h5 class="font-semibold mt-2">15. Fuerza Mayor</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">No seremos responsables por cualquier incumplimiento de nuestras obligaciones si este
                    incumplimiento se debe a eventos fuera de nuestro control razonable, como desastres naturales,
                    conflictos laborales, pandemias, fallos en sistemas de transporte, entre otros.</li>
            </ul>
            <h5 class="font-semibold mt-2">16. Uso de Productos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">

                <li class=" mt-2">Todos los productos vendidos en nuestra tienda están destinados para el uso indicado
                    en su descripción. No nos hacemos responsables por daños o efectos adversos que puedan surgir del
                    uso inadecuado de los productos, tanto naturales como no naturales.</li>
                <li class=" mt-2">En el caso de productos naturales, el cliente es responsable de verificar si tiene
                    alergias o intolerancias a alguno de los ingredientes del producto antes de su uso.</li>
            </ul>
            <h5 class="font-semibold mt-2">17. Aceptación de los Términos</h5>
            <ul class=" text-sm list-disc pl-6 text-justify">
                <li class=" mt-2">Al completar una compra, el cliente acepta estos términos y condiciones, y reconoce
                    que ha sido informado sobre las políticas de entrega, devoluciones, y las características del
                    producto adquirido.</li>
            </ul>
        </div>
        <div class=" text-right mt-6">

            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['xOn:click' => '$wire.terms = false']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-on:click' => '$wire.terms = false']); ?>Cerrar
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $attributes = $__attributesOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__attributesOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $component = $__componentOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__componentOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>

</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/purchase-policy-and-conditions.blade.php ENDPATH**/ ?>