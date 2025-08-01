<flux:field variant="inline">
    <flux:checkbox wire:model.live="terms"/>

    <flux:label>
        <span class=" text-ink">He leído y acepto los</span>

        <flux:modal.trigger name="terms-modal">
            <span class="font-medium text-secondary hover:underline cursor-pointer ml-1">
                Términos y Condiciones
            </span>
        </flux:modal.trigger>
        <span class=" text-ink">Y el</span>
        <flux:modal.trigger name="contract-modal">
            <span class="font-medium text-secondary hover:underline cursor-pointer ml-1">
                Contrato de Afiliación como Distribuidor Independiente de Fornuvi S.A.S,
            </span>
        </flux:modal.trigger>
        <span class=" text-ink">los cuales he leído previamente y entiendo en su totalidad.</span>

    </flux:label>

    <flux:error name="terms" />
</flux:field>

{{-- ================================================================= --}}
{{--                   MODAL CON EL CONTRATO MEJORADO                  --}}
{{-- ================================================================= --}}

{{-- Se añade 'max-w-4xl' para una mejor lectura en pantallas grandes --}}
<flux:modal name="terms-modal" class="w-full max-w-4xl">

    {{-- Título del modal mejorado --}}
    <div class="border-b border-gray-200 pb-4 mb-4">
        <h1 class="text-xl text-primary font-bold text-center">
            TÉRMINOS Y CONDICIONES GENERALES DE FORNUVI S.A.S.
        </h1>
        <p class="text-center text-sm text-gray-500 mt-1">
            Uso del Sitio Web y Proceso de Registro en Línea
        </p>
    </div>

    {{-- Contenedor del texto con mejor espaciado y legibilidad --}}
    <div class="p-2 sm:p-6 text-ink text-justify space-y-4 leading-relaxed text-sm max-h-[60vh] overflow-y-auto">

        <h2 class="text-lg font-bold text-gray-800 pt-2 pb-2 border-b border-gray-200">
            1. ACEPTACIÓN E INFORMACIÓN GENERAL
        </h2>
        <p>
            Bienvenido a la plataforma en línea de <b>FORNUVI S.A.S.</b> (en adelante, “LA COMPAÑÍA”), sociedad
            comercial identificada con NIT 901.953.881-1, con domicilio en Cali, Colombia.
        </p>
        <p>
            Estos Términos y Condiciones Generales (en adelante, "T&C") regulan el acceso, la navegación y el uso del
            sitio web oficial de LA COMPAÑÍA (en adelante, el "Sitio Web"), así como el proceso de registro en línea
            para aspirantes a Distribuidores Independientes.
        </p>
        <p>
            Cualquier persona que acceda, navegue o utilice el Sitio Web (en adelante, el “Usuario”) declara ser mayor
            de edad, tener plena capacidad legal para obligarse y aceptar, sin reserva ni condición alguna, todos y
            cada uno de los presentes T&C. Si el Usuario no está de acuerdo con estos términos, debe abstenerse de
            utilizar el Sitio Web y de iniciar cualquier proceso de registro.
        </p>
        <p>
            Estos T&C se complementan con el <b>Contrato de Vinculación Comercial para Distribuidor Independiente</b>, el cual
            regula específicamente la relación mercantil entre LA COMPAÑÍA y sus Distribuidores Independientes.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            2. OBJETO DEL SITIO WEB
        </h2>
        <p>
            El Sitio Web tiene como finalidad principal:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>Presentar información corporativa sobre LA COMPAÑÍA, su modelo de negocio, productos y alianzas.</li>
            <li>Servir como plataforma para el registro en línea de nuevos Distribuidores Independientes.</li>
            <li>Proporcionar un portal de acceso (oficina virtual) para los Distribuidores Independientes activos.</li>
            <li>Facilitar la comunicación entre LA COMPAÑÍA y sus Usuarios y Distribuidores.</li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            3. PROCESO DE REGISTRO COMO DISTRIBUIDOR INDEPENDIENTE
        </h2>
        <p>
            <b>3.1. Voluntariedad y Requisitos:</b> El registro como Distribuidor Independiente es un acto completamente
            voluntario. Para poder registrarse, el Usuario debe ser mayor de edad, residente legal en Colombia y
            proporcionar información veraz, precisa, completa y actualizada en el formulario de registro. El Usuario es
            el único responsable de la exactitud de los datos suministrados.
        </p>
        <p>
            <b>3.2. Aceptación Dual:</b> El proceso de registro culmina con la aceptación expresa de dos documentos
            fundamentales: (a) los presentes Términos y Condiciones y (b) el Contrato de Vinculación Comercial. Al
            marcar la casilla de verificación: "☑️ He leído y acepto los Términos y Condiciones y el Contrato de
            Afiliación...", el Usuario manifiesta su consentimiento libre e informado para quedar vinculado por ambos
            documentos.
        </p>
        <p>
            <b>3.3. Perfeccionamiento:</b> La relación como Distribuidor Independiente solo se considerará perfeccionada una
            vez que el registro haya sido completado y aceptado por LA COMPAÑÍA, quien se reserva el derecho de admitir
            o rechazar cualquier solicitud.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            4. OBLIGACIONES DEL USUARIO
        </h2>
        <p>
            El Usuario se compromete a utilizar el Sitio Web de manera diligente, correcta y lícita, y a abstenerse de:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>Utilizar el Sitio Web con fines o efectos ilícitos, fraudulentos, o contrarios a la ley y el orden
                público.</li>
            <li>Reproducir, copiar, distribuir o modificar los contenidos sin autorización expresa de LA COMPAÑÍA.</li>
            <li>Introducir virus informáticos o cualquier sistema que pueda dañar los sistemas de LA COMPAÑÍA.</li>
            <li>Intentar acceder a áreas restringidas o cuentas de otros usuarios sin autorización.</li>
        </ul>


        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            5. PROPIEDAD INTELECTUAL E INDUSTRIAL
        </h2>
        <p>
            Todos los derechos de propiedad intelectual sobre el Sitio Web y sus contenidos, incluyendo textos,
            gráficos, logotipos, marcas y software (el "Contenido"), son propiedad exclusiva de LA COMPAÑÍA o de
            terceros que han autorizado su uso. El acceso al Sitio Web no confiere al Usuario ningún derecho sobre dicho
            Contenido. Queda estrictamente prohibida su explotación sin autorización previa y por escrito.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            6. EXCLUSIÓN DE RESPONSABILIDAD
        </h2>
        <p>
            <b>6.1. Disponibilidad del Sitio Web:</b> LA COMPAÑÍA no garantiza la disponibilidad ininterrumpida del
            Sitio Web y no asume responsabilidad por daños derivados de su falta de disponibilidad o continuidad.
        </p>
        <p>
            <b>6.2. Información de Terceros:</b> El Sitio Web puede contener enlaces a sitios de terceros (ej. comercios
            aliados). LA COMPAÑÍA no se hace responsable por el contenido, políticas o prácticas de dichos sitios.
        </p>
        <p>
            <b>6.3. Declaraciones de Ingresos:</b> LA COMPAÑÍA no garantiza ningún nivel de ingresos. Cualquier ejemplo
            de ganancias es solo para fines ilustrativos y no constituye una promesa. El éxito depende del esfuerzo y
            habilidades personales del Distribuidor Independiente.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            7. POLÍTICA DE PRIVACIDAD Y TRATAMIENTO DE DATOS
        </h2>
        <p>
            Al aceptar estos T&C, el Usuario autoriza el tratamiento de sus datos personales conforme a la <b>Política
                de Tratamiento de Datos Personales</b> de LA COMPAÑÍA, en armonía con la Ley 1581 de 2012. Los detalles
            sobre finalidades, derechos y canales de contacto se encuentran en la <b>CLÁUSULA DÉCIMA del Contrato de
                Vinculación Comercial</b>, que forma parte integral de este acuerdo.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            8. MODIFICACIONES
        </h2>
        <p>
            LA COMPAÑÍA se reserva el derecho a modificar en cualquier momento los presentes T&C. Es responsabilidad
            del Usuario revisarlos periódicamente. El uso continuado del Sitio Web tras una modificación constituirá la
            aceptación de los nuevos términos.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            9. LEY APLICABLE Y JURISDICCIÓN
        </h2>
        <p>
            Estos T&C se rigen por las leyes de la República de Colombia. Para cualquier controversia, las partes se
            someten a la jurisdicción de los jueces y tribunales de la ciudad de Cali, Colombia.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            10. CONTACTO
        </h2>
        <p>
            Para cualquier duda o consulta sobre estos T&C, el Usuario puede contactar a LA COMPAÑÍA a través de:
            Correo Electrónico: info@fornuvi.com | Teléfono: +573145207814
        </p>

        <p class="pt-8 text-center text-xs text-gray-500">
            Última actualización: Julio 2024
        </p>
    </div>

    {{-- Acciones del Modal --}}
    <div class="flex pt-4">
        <flux:spacer />
        <flux:button x-on:click="$flux.modal('terms-modal').close()" variant="primary">Entendido, Cerrar
        </flux:button>
    </div>

</flux:modal>


<flux:modal name="contract-modal" class="w-full max-w-4xl">

    {{-- Título del modal mejorado --}}
    <div class="border-b border-gray-200 pb-4 mb-4">
        <h1 class="text-xl text-primary font-bold text-center">
            CONTRATO DE VINCULACIÓN COMERCIAL PARA DISTRIBUIDOR INDEPENDIENTE
        </h1>
        <p class="text-center text-sm text-gray-500 mt-1">
            Entre FORNUVI S.A.S. y EL DISTRIBUIDOR INDEPENDIENTE
        </p>
    </div>

    {{-- Contenedor del texto con mejor espaciado y legibilidad --}}
    <div class="p-2 sm:p-6 text-ink text-justify space-y-4 leading-relaxed text-sm max-h-[60vh] overflow-y-auto">

        <p>
            <b>FORNUVI S.A.S.</b>, sociedad comercial legalmente constituida bajo las leyes de la República de Colombia,
            identificada con NIT 901.953.881-1, con domicilio principal en la ciudad de Cali (en adelante, “LA
            COMPAÑÍA”).
        </p>
        <p> Y:</p>
        <p>
            La persona natural o jurídica que acepta los términos del presente documento de manera electrónica
            mediante la marcación de la casilla de aceptación (en adelante, “EL DISTRIBUIDOR INDEPENDIENTE”).
            Ambas partes, denominadas conjuntamente como “LAS PARTES”, han acordado celebrar el presente Contrato de
            Vinculación Comercial, el cual se regirá por la legislación colombiana, en especial la Ley 1700 de 2013, y
            por las siguientes cláusulas:
        </p>

        {{-- Títulos de cláusulas mejorados para una mejor jerarquía visual --}}
        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            DECLARACIONES:
        </h2>

        <ol class="list-decimal pl-5 space-y-4">
            <li>
                LA COMPAÑÍA declara que su objeto social principal consiste en la estructuración, desarrollo y operación
                de
                un sistema de comercialización en red o marketing multinivel, conforme a la Ley 1700 de 2013. Dicha
                actividad se materializa a través de una plataforma que integra un portafolio de oportunidades
                comerciales
                para sus Distribuidores Independientes, el cual podrá incluir, de manera no limitativa, las siguientes
                modalidades:
                <ul class="list-disc pl-5 mt-3 space-y-2">
                    <li>
                        <b>Intermediación Comercial:</b> La operación de una plataforma de comercio electrónico para la
                        venta
                        de productos suministrados por LA COMPAÑÍA o por terceros proveedores.
                    </li>
                    <li>
                        <b>Programa de Referidos con Aliados:</b> La gestión de un programa de beneficios y
                        compensaciones basado en
                        alianzas estratégicas con establecimientos de comercio externos, mediante el cual se generan
                        ingresos
                        derivados del consumo realizado por la red en dichos establecimientos.
                    </li>
                    <li>
                        <b>Distribución de Productos Propios:</b> Eventualmente, la distribución y venta directa de
                        productos
                        desarrollados o marcados por LA COMPAÑÍA.
                    </li>
                </ul>
            </li>
            <li>
                EL DISTRIBUIDOR INDEPENDIENTE declara ser mayor de edad, con plena capacidad legal para contratar y
                obligarse, y manifiesta su interés voluntario de vincularse a la red comercial de LA COMPAÑÍA bajo la
                modalidad de Distribuidor Independiente.
            </li>
        </ol>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA PRIMERA: OBJETO DEL CONTRATO
        </h2>
        <p>
            El objeto de este contrato es establecer los términos y condiciones que regulan la relación comercial, de
            carácter mercantil e independiente, entre LA COMPAÑÍA y EL DISTRIBUIDOR INDEPENDIENTE. En virtud de esta
            relación, EL DISTRIBUIDOR INDEPENDIENTE promoverá y comercializará los productos y/o servicios ofrecidos en la
            plataforma de LA COMPAÑÍA, y
            podrá desarrollar una red de distribución, a cambio de las compensaciones económicas establecidas en el Plan
            de Compensación vigente.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">CLÁUSULA SEGUNDA: ACEPTACIÓN Y
            PERFECCIONAMIENTO</h2>
        <p>
            EL DISTRIBUIDOR INDEPENDIENTE manifiesta que, al marcar la casilla "☑️ He leído y acepto los Términos y
            Condiciones y el Contrato de Afiliación como Distribuidor Independiente de Fornuvi S.A.S, el cual he leído
            previamente y entiendo en su totalidad", está firmando y aceptando de manera libre, expresa e inequívoca el
            contenido íntegro de este contrato, el cual adquiere plena validez y fuerza vinculante entre LAS PARTES.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA TERCERA: NATURALEZA DE LA RELACIÓN
        </h2>
        <p>
            LAS PARTES acuerdan y reconocen que la relación que surge de este contrato es de naturaleza estrictamente
            mercantil y autónoma. En consecuencia:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>
                <b>No existe relación laboral:</b> Este contrato no crea, ni se interpretará como creador de, una
                relación
                laboral, contrato de trabajo, sociedad o empresa conjunta entre LA COMPAÑÍA y EL DISTRIBUIDOR INDEPENDIENTE.
            </li>
            <li>
                <b>Independencia y Autonomía:</b> EL DISTRIBUIDOR INDEPENDIENTE no estará sujeto a subordinación, no
                cumplirá un
                horario de trabajo impuesto por LA COMPAÑÍA, y desarrollará su actividad con sus propios medios, bajo su
                propio riesgo y autonomía.
            </li>
            <li>
                <b>Responsabilidades Tributarias y de Seguridad Social:</b> EL DISTRIBUIDOR INDEPENDIENTE es el único
                responsable
                de la declaración y pago de todos sus impuestos (IVA, Renta, Retención en la Fuente, etc.), así como de
                sus afiliaciones y cotizaciones al Sistema de Seguridad Social Integral (salud, pensión y riesgos
                laborales) como trabajador independiente, conforme a la ley colombiana.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA CUARTA: REQUISITOS DE VINCULACIÓN
        </h2>
        <p>
            Para ser y permanecer como DISTRIBUIDOR INDEPENDIENTE, se deberá cumplir con lo siguiente:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>Ser mayor de edad y residente legal en Colombia.</li>
            <li>Suministrar información personal veraz, completa y actualizada durante el registro y mantenerla así
                durante la vigencia del contrato.</li>
            <li>No haber sido suspendido o terminado de forma definitiva de la red de LA COMPAÑÍA por incumplimiento
                grave de sus políticas.</li>
            <li>Aceptar este contrato y cumplir con todas las políticas, códigos de ética y manuales emitidos por LA
                COMPAÑÍA.</li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA QUINTA: DERECHOS DEL DISTRIBUIDOR INDEPENDIENTE
        </h2>
        <p>
            EL DISTRIBUIDOR INDEPENDIENTE tendrá derecho a:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>
                Recibir las compensaciones económicas (comisiones, bonos, incentivos) de acuerdo con lo estipulado en el
                Plan de Compensación vigente.
            </li>
            <li>
                Acceder a capacitaciones, material de apoyo, herramientas digitales y soporte proporcionado por LA
                COMPAÑÍA.
            </li>
            <li>
                Adquirir los productos ofrecidos por LA COMPAÑÍA.
            </li>
            <li>
                Terminar unilateralmente y en cualquier momento el presente contrato, mediante notificación escrita a LA
                COMPAÑÍA, sin que ello genere penalización alguna.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA SEXTA: OBLIGACIONES DEL DISTRIBUIDOR INDEPENDIENTE
        </h2>
        <p>
            EL DISTRIBUIDOR INDEPENDIENTE se obliga a:
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>
                Actuar siempre con ética, honestidad, transparencia y profesionalismo, protegiendo la reputación de LA
                COMPAÑÍA.
            </li>
            <li>
                Promover y vender los productos basándose en sus características y beneficios reales, sin incurrir en
                publicidad engañosa, exageraciones o promesas de ganancias garantizadas.
            </li>
            <li>
                Cumplir estrictamente con el Plan de Compensación, el Código de Ética y demás políticas internas de LA
                COMPAÑÍA.
            </li>
            <li>
                No utilizar las marcas, logos y nombres comerciales de LA COMPAÑÍA para fines distintos a los
                autorizados en este contrato.
            </li>
            <li>
                Mantener la confidencialidad sobre la información privilegiada de LA COMPAÑÍA a la que tenga acceso.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA SÉPTIMA: PLAN DE COMPENSACIÓN
        </h2>
        <p>
            El Plan de Compensación de LA COMPAÑÍA es un documento anexo que forma parte integral de este contrato.
            Dicho plan detalla la estructura de ingresos, los requisitos para calificar a los distintos rangos y las
            formas de pago.
        </p>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            {{-- <li>
                EL DISTRIBUIDOR INDEPENDIENTE declara haber leído, comprendido y aceptado el Plan de Compensación en su
                totalidad.
            </li> --}}
            <li>
                Se deja constancia expresa que las compensaciones se derivan principalmente de la venta de productos y/o
                servicios a consumidores finales, ya sea directamente o a través de su red de distribución, y no del
                mero hecho de reclutar a otras personas.
            </li>
            <li>
                LA COMPAÑÍA mantendrá el Plan de Compensación actualizado y accesible para consulta a través de la
                pagina oficial de Fornvui.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA OCTAVA: POLÍTICA DE DEVOLUCIÓN Y GARANTÍA
        </h2>
        <p>
            Esta política regula las transacciones de productos y/o servicios adquiridos directamente desde la tienda
            virtual o plataforma de LA COMPAÑÍA.
        </p>
        <ol class="list-decimal pl-5 space-y-4 mt-4">
            <li>
                <b>Exclusión de Transacciones con Comercios Aliados:</b> Se deja constancia expresa de que LA COMPAÑÍA
                actúa como un simple intermediario en las transacciones que EL DISTRIBUIDOR INDEPENDIENTE o su red realicen
                en los establecimientos de comercios aliados. Por lo tanto, cualquier solicitud de devolución, garantía,
                cambio o reclamación sobre productos o servicios adquiridos en dichos comercios aliados deberá ser
                gestionada directamente por el comprador ante el comercio tercero, rigiéndose por las políticas propias
                de dicho establecimiento. LA COMPAÑÍA no asume ninguna responsabilidad sobre estas transacciones.
            </li>
            <li>
                <b>Derecho de Retracto (Compras en la Plataforma Fornuvi):</b> Conforme al artículo 47 de la Ley 1480 de
                2011, EL DISTRIBUIDOR INDEPENDIENTE podrá ejercer el derecho de retracto sobre los productos adquiridos
                directamente de LA COMPAÑÍA dentro de los cinco (5) días hábiles siguientes a la entrega del producto.
                Para ello, deberá devolver el producto en las mismas condiciones en que lo recibió, sin haber sido
                usado, y asumir los costos de transporte de la devolución. Una vez recibido y verificado el producto, LA
                COMPAÑÍA procederá con la reversión del pago.
            </li>
            <li>
                <b>Garantía de Recompra (Terminación del Contrato):</b> Aunque el modelo de negocio de Fornuvi se centra
                en el consumo personal y no incentiva la acumulación de inventarios, en estricto cumplimiento con la Ley
                1700 de 2013, LA COMPAÑÍA ofrece la siguiente garantía de recompra al momento de la terminación del
                contrato:
                <ul class="list-disc pl-5 mt-3 space-y-2">
                    <li>LA COMPAÑÍA recomprará los productos no perecederos que el Distribuidor Independiente haya adquirido
                        directamente de LA COMPAÑÍA y que aún se encuentren en su poder.</li>
                    <li>Los productos deben estar en perfecto estado, sin usar, sellados, en su empaque original (aptos
                        para reventa) y con una fecha de expiración vigente.</li>
                    <li>La solicitud debe realizarse sobre productos adquiridos dentro de los seis (6) meses previos a
                        la terminación del contrato.</li>
                    <li>LA COMPAÑÍA reembolsará un mínimo del noventa por ciento (90%) del costo neto original pagado
                        por el Distribuidor.</li>
                    <li>Del valor a reembolsar se descontarán los gastos de envío y los beneficios económicos
                        (comisiones, puntos, bonos, etc.) que la compra original hubiera generado para el Distribuidor o su
                        línea ascendente. La solicitud debe realizarse dentro de los dos (2) meses siguientes a la
                        terminación efectiva del contrato.</li>
                </ul>
            </li>
        </ol>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA NOVENA: DURACIÓN Y TERMINACIÓN
        </h2>
        <ul class="list-disc pl-5 mt-4 space-y-3">
            <li>
                <b>Duración:</b> El presente contrato es de término indefinido y estará vigente mientras LAS PARTES
                cumplan con
                sus obligaciones.
            </li>
            <li>
                <b>Terminación por parte del Distribuidor Independiente:</b> Podrá dar por terminado el contrato en
                cualquier
                momento, sin necesidad de justificar la causa, mediante notificación escrita enviada al correo
                electrónico de contacto de LA COMPAÑÍA.
            </li>
            <li>
                <b>Terminación por parte de LA COMPAÑÍA:</b> LA COMPAÑÍA podrá dar por terminado este contrato de forma
                inmediata y sin previo aviso en caso de:
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Incumplimiento grave de cualquiera de las cláusulas de este contrato, del Código de Ética o de
                        las políticas de la empresa.</li>
                    <li>
                        Realización de actos fraudulentos, ilegales o que perjudiquen la reputación de LA COMPAÑÍA.
                    </li>
                    <li>
                        Inactividad prolongada según los criterios definidos en las políticas internas.
                    </li>
                </ul>
            </li>
            <li>
                <b>Efectos de la Terminación:</b> Una vez terminado el contrato, EL DISTRIBUIDOR INDEPENDIENTE perderá su
                estatus,
                no podrá representar a LA COMPAÑÍA, y se procederá a la liquidación final de las comisiones generadas y
                no pagadas, sujeto a las condiciones de este contrato.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA DÉCIMA: TRATAMIENTO DE DATOS PERSONALES
        </h2>
        <p>
            EL DISTRIBUIDOR INDEPENDIENTE, al aceptar este contrato, autoriza de manera previa, explícita e informada a LA
            COMPAÑÍA para el tratamiento de sus datos personales, conforme a la Ley 1581 de 2012 y sus decretos
            reglamentarios.
        </p>
        <ul class="list-disc pl-5 space-y-3 mt-4">
            <li>
                <b>Responsable del Tratamiento:</b> FORNUVI S.A.S., NIT 901.953.881-1, correo electrónico
                info@fornuvi.com, teléfono +573145207814.
            </li>
            <li>
                <b>Datos Recolectados:</b> LA COMPAÑÍA podrá recolectar datos de identificación (nombre, cédula), de
                contacto (dirección, email, teléfono), financieros (cuentas bancarias para pagos), y datos
                transaccionales derivados de la actividad comercial.
            </li>
            <li>
                <b>Finalidades del Tratamiento:</b> Sus datos serán utilizados para:
                <ol class="list-alpha pl-5 mt-2 space-y-1">
                    <li>Gestionar la vinculación, ejecución y terminación de la relación contractual.</li>
                    <li>Calcular, liquidar y realizar los pagos de las compensaciones económicas.</li>
                    <li>Enviar comunicaciones administrativas, operativas y comerciales relacionadas con el negocio.
                    </li>
                    <li>Ofrecer soporte, capacitación y herramientas para el desarrollo de la actividad.</li>
                    <li>Realizar análisis estadísticos para la mejora de productos y servicios.</li>
                    <li>Cumplir con obligaciones legales, fiscales y regulatorias ante las autoridades competentes.</li>
                </ol>
            </li>
            <li>
                <b>Derechos del Titular:</b> Como titular de la información, tiene derecho a conocer, actualizar,
                rectificar y suprimir sus datos, así como a revocar esta autorización. Podrá ejercer estos derechos
                enviando una solicitud al correo electrónico info@fornuvi.com, indicando claramente su petición.
            </li>
            <li>
                <b>Vigencia:</b> La autorización para el tratamiento de datos permanecerá vigente durante la duración de
                la relación contractual y por el tiempo adicional requerido para cumplir con obligaciones legales y/o
                contractuales.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA UNDÉCIMA: MODIFICACIONES
        </h2>
        <p>
            LA COMPAÑÍA se reserva el derecho de modificar unilateralmente este contrato, el Plan de Compensación o sus
            políticas. Cualquier modificación será notificada a EL DISTRIBUIDOR INDEPENDIENTE a través de su correo
            electrónico registrado o de la plataforma interna con al menos quince (15) días de antelación a su entrada
            en vigor. La continuación de las actividades por parte del Distribuidor Independiente después de la notificación
            se entenderá como una aceptación tácita de los cambios.
        </p>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA DUODÉCIMA: LEY APLICABLE, JURISDICCIÓN Y SUPERVISIÓN
        </h2>
        <ul class="list-disc pl-5 mt-4 space-y-2">
            <li>
                Este contrato se rige íntegramente por las leyes de la República de Colombia.
            </li>
            <li>
                Toda controversia o diferencia relativa a este contrato se intentará resolver en primera instancia
                mediante negociación directa entre LAS PARTES.
            </li>
            <li>
                Si no se llega a un acuerdo, LAS PARTES se someterán a la jurisdicción de los jueces y tribunales
                competentes de la ciudad de Cali, Colombia, renunciando a cualquier otro fuero que pudiera
                corresponderles.
            </li>
            <li>
                Se informa a EL DISTRIBUIDOR INDEPENDIENTE que las actividades multinivel en Colombia son vigiladas por la
                Superintendencia de Sociedades.
            </li>
        </ul>

        <h2 class="text-lg font-bold text-gray-800 pt-6 pb-2 border-b border-gray-200">
            CLÁUSULA DECIMOTERCERA: CONTACTO
        </h2>
        <p>
            Para cualquier comunicación, notificación, petición, queja o reclamo, el canal oficial de contacto es:
            Correo Electrónico: info@fornuvi.com |
            Teléfono: +573145207814
        </p>

        <p class="pt-8 text-center text-xs text-gray-500">
            Última actualización: Julio 2024
        </p>
    </div>

    {{-- Acciones del Modal --}}
    <div class="flex pt-4">
        <flux:spacer />
        <flux:button x-on:click="$flux.modal('contract-modal').close()" variant="primary">Entendido, Cerrar
        </flux:button>
    </div>

</flux:modal>
