<div>
    <div class=" flex justify-between items-center mb-2">
        <h1 class=" font-bold  text-palette-200">
            <?php echo e($isEditMode ? 'Editar producto' : 'Crear porducto'); ?></h1>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.products.calculadora-financiera');

$__html = app('livewire')->mount($__name, $__params, 'lw-2096745913-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

    <div class="p-4 rounded-lg bg-white border border-palette-200/25 shadow-lg shadow-palette-800">
        <form wire:submit.prevent="<?php echo e($isEditMode ? 'update' : 'save'); ?>" x-on:submit="$refs.fileInput.value = ''">
            <div class=" grid grid-cols-6 gap-4 gap-y-2">

                <div class="col-span-6 md:col-span-2">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','label' => 'Nombre:','for' => 'name','wire:model.live' => 'name','autofocus' => true,'autocomplete' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','label' => 'Nombre:','for' => 'name','wire:model.live' => 'name','autofocus' => true,'autocomplete' => 'name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class=" col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'Precio publico:','for' => 'final_price','wire:model.blur' => 'final_price','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Precio publico:','for' => 'final_price','wire:model.blur' => 'final_price','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>
                <div class=" col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'iva %:','for' => 'tax_percent','wire:model.blur' => 'tax_percent','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'iva %:','for' => 'tax_percent','wire:model.blur' => 'tax_percent','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>
                <div class=" col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'Precio sin iva','for' => 'price','wire:model.blur' => 'price','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Precio sin iva','for' => 'price','wire:model.blur' => 'price','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class=" col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'Comisione inicio:','for' => 'commission_income','wire:model' => 'commission_income','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Comisione inicio:','for' => 'commission_income','wire:model' => 'commission_income','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>
                <div class=" col-span-6 md:col-span-1 relative">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'pts_base:','for' => 'pts_base','wire:model.live' => 'pts_base','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'pts_base:','for' => 'pts_base','wire:model.live' => 'pts_base','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class=" col-span-6 md:col-span-1 relative">

                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'pts_bonus:','for' => 'pts_bonus','wire:model.live' => 'pts_bonus','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'pts_bonus:','for' => 'pts_bonus','wire:model.live' => 'pts_bonus','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class=" col-span-6 md:col-span-1 relative">

                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'pts_dist:','for' => 'pts_dist','wire:model.live' => 'pts_dist','step' => '0.01','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'pts_dist:','for' => 'pts_dist','wire:model.live' => 'pts_dist','step' => '0.01','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'Descuento %:','for' => 'maximum_discount','wire:model.live' => 'maximum_discount','min' => '0','max' => '100','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Descuento %:','for' => 'maximum_discount','wire:model.live' => 'maximum_discount','min' => '0','max' => '100','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>
                <div class="col-span-6 md:col-span-1">
                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','label' => 'Stock:','for' => 'stock','wire:model' => 'stock','min' => '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','label' => 'Stock:','for' => 'stock','wire:model' => 'stock','min' => '0','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <?php if (isset($component)) { $__componentOriginale28a73fb8227249e2c0ecc51d606a113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale28a73fb8227249e2c0ecc51d606a113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-l','data' => ['label' => 'Tangible:','for' => 'is_physical','wire:model.live' => 'is_physical']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tangible:','for' => 'is_physical','wire:model.live' => 'is_physical']); ?>
                        <option value="1">tangible</option>
                        <option value="0">intangible</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $attributes = $__attributesOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $component = $__componentOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__componentOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <?php if (isset($component)) { $__componentOriginale28a73fb8227249e2c0ecc51d606a113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale28a73fb8227249e2c0ecc51d606a113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-l','data' => ['label' => 'Permitir pedidos pendientes:','for' => 'allow_backorder','wire:model.live' => 'allow_backorder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Permitir pedidos pendientes:','for' => 'allow_backorder','wire:model.live' => 'allow_backorder']); ?>
                        <option value="1">Permitir</option>
                        <option value="0">No permitir</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $attributes = $__attributesOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $component = $__componentOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__componentOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6 md:col-span-2">
                    <?php if (isset($component)) { $__componentOriginale28a73fb8227249e2c0ecc51d606a113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale28a73fb8227249e2c0ecc51d606a113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-l','data' => ['label' => 'Producto activo:','for' => 'is_active','wire:model.live' => 'is_active']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Producto activo:','for' => 'is_active','wire:model.live' => 'is_active']); ?>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $attributes = $__attributesOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $component = $__componentOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__componentOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6" wire:ignore>
                    <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::label','data' => ['for' => 'descripcion:']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'descripcion:']); ?>Descripcion: <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                    <textarea id="editor" wire:model.live="description"> <?php echo e($description); ?>

                    </textarea>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'description']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6" wire:ignore>
                    <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::label','data' => ['for' => 'Specifications']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'Specifications']); ?>Specifications: <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                    <textarea id="editor2" wire:model.live="specifications"> <?php echo e($specifications); ?>

                    </textarea>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'specifications']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'specifications']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                <div class="col-span-6" wire:ignore>
                    <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::label','data' => ['for' => 'information']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'information']); ?>Information: <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                    <textarea id="editor3" wire:model.live="information"> <?php echo e($information); ?>

                    </textarea>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['for' => 'information']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'information']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categoryLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if($categories->isNotEmpty()): ?>
                        <div class="sm:col-span-2">
                            <?php if (isset($component)) { $__componentOriginale28a73fb8227249e2c0ecc51d606a113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale28a73fb8227249e2c0ecc51d606a113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-l','data' => ['label' => ''.e($level === 0 ? 'Categoría:' : 'Subcategoría nivel ' . $level).'','for' => 'level_'.e($level).'','wire:model.live' => 'selectedLevels.'.e($level).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => ''.e($level === 0 ? 'Categoría:' : 'Subcategoría nivel ' . $level).'','for' => 'level_'.e($level).'','wire:model.live' => 'selectedLevels.'.e($level).'']); ?>
                                <option value="">Ninguno</option>

                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $attributes = $__attributesOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $component = $__componentOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__componentOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                <div class="col-span-6 md:col-span-2">
                    <!--[if BLOCK]><![endif]--><?php if($brands): ?>
                        <?php if (isset($component)) { $__componentOriginale28a73fb8227249e2c0ecc51d606a113 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale28a73fb8227249e2c0ecc51d606a113 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-l','data' => ['label' => 'Marca:','for' => 'brand_id','wire:model.live' => 'brand_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Marca:','for' => 'brand_id','wire:model.live' => 'brand_id']); ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="">Ninguno</option>
                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $attributes = $__attributesOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__attributesOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale28a73fb8227249e2c0ecc51d606a113)): ?>
<?php $component = $__componentOriginale28a73fb8227249e2c0ecc51d606a113; ?>
<?php unset($__componentOriginale28a73fb8227249e2c0ecc51d606a113); ?>
<?php endif; ?>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!--[if BLOCK]><![endif]--><?php if($hasChildCategories === false): ?>
                    <div class="col-span-6">
                        <p class="text-sm text-red-600">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            La categoría seleccionada tiene subcategorías. Por favor, seleccione una categoría del
                            último nivel.
                        </p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="col-span-6 form-group">
                    <?php if (isset($component)) { $__componentOriginalfc214a4703f6cdb37d3c05482e3534ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc214a4703f6cdb37d3c05482e3534ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-file-l','data' => ['label' => 'Imagenes:','for' => 'newImages','wire:model' => 'newImages','xRef' => 'fileInput','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-file-l'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Imagenes:','for' => 'newImages','wire:model' => 'newImages','x-ref' => 'fileInput','wire:loading.attr' => 'disabled']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc214a4703f6cdb37d3c05482e3534ba)): ?>
<?php $attributes = $__attributesOriginalfc214a4703f6cdb37d3c05482e3534ba; ?>
<?php unset($__attributesOriginalfc214a4703f6cdb37d3c05482e3534ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc214a4703f6cdb37d3c05482e3534ba)): ?>
<?php $component = $__componentOriginalfc214a4703f6cdb37d3c05482e3534ba; ?>
<?php unset($__componentOriginalfc214a4703f6cdb37d3c05482e3534ba); ?>
<?php endif; ?>
                </div>

            </div>

            <!-- Existing Images -->
            <!--[if BLOCK]><![endif]--><?php if($isEditMode): ?>
                 <div class=" mt-4">
                    <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::label','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Imágenes Existentes: <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-2 ">
                        
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                class="relative bg-white shadow-md shadow-palette-300  border border-palette-200  rounded-lg flex items-center justify-center p-2">
                                <div class="">
                                    <img src="<?php echo e(Storage::url($path)); ?>" class="h-20 object-cover"
                                        alt="Imagen del Negocio">

                                    
                                    <button type="button" wire:click="removeMedia(<?php echo e($id); ?>)"
                                        wire:confirm="¿Estás seguro de eliminar esta imagen?"
                                        class=" absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs">
                                        X
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <div class=" flex items-center justify-end mt-4">
                <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80"
                    href="<?php echo e(route('admin.products.index')); ?>"> <i class="fas fa-arrow-left"></i></a>

                <?php if (isset($component)) { $__componentOriginal5b0b89a917ec27521ca21906b3f381b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b0b89a917ec27521ca21906b3f381b2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-dynamic','data' => ['type' => 'submit','wire:loading.attr' => 'disabled','wire:target' => 'save,update']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-dynamic'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','wire:loading.attr' => 'disabled','wire:target' => 'save,update']); ?>
                    <span wire:loading.remove wire:target="save,update">
                        <?php echo e($isEditMode ? 'Actualizar' : 'Guardar'); ?>

                    </span>
                    <span wire:loading wire:target="save,update">
                        Procesando...
                    </span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b0b89a917ec27521ca21906b3f381b2)): ?>
<?php $attributes = $__attributesOriginal5b0b89a917ec27521ca21906b3f381b2; ?>
<?php unset($__attributesOriginal5b0b89a917ec27521ca21906b3f381b2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b0b89a917ec27521ca21906b3f381b2)): ?>
<?php $component = $__componentOriginal5b0b89a917ec27521ca21906b3f381b2; ?>
<?php unset($__componentOriginal5b0b89a917ec27521ca21906b3f381b2); ?>
<?php endif; ?>
            </div>

        </form>
    </div>


    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(function(editor) {
                editor.model.document.on('change:data', () => {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('description', editor.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(function(editor2) {
                editor2.model.document.on('change:data', () => {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('specifications', editor2.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .then(function(editor3) {
                editor3.model.document.on('change:data', () => {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('information', editor3.getData());
                });
            })
            .catch(error => {
                Console.error(error);
            });
    </script>

</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/admin/products/product-form.blade.php ENDPATH**/ ?>