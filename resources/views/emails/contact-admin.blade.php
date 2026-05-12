<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #b91c1c; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
        <?php if ($logoUrl): ?>
            <img src="<?php echo e($logoUrl); ?>" alt="Funeraria García de Bolívar" style="max-height: 80px; max-width: 200px;">
        <?php else: ?>
            <h1 style="margin: 0; font-size: 24px;">Funeraria García de Bolívar</h1>
        <?php endif; ?>
        <p style="margin: 5px 0 0 0; font-size: 14px;">Nuevo mensaje de contacto recibido</p>
    </div>

    <div style="background-color: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; border: 1px solid #ddd;">
        <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #555; font-size: 16px;">Datos del mensaje:</h3>
            <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">
            <p><strong>Fecha:</strong> <?php echo e(date('d/m/Y H:i')); ?></p>
            <p><strong>Nombre:</strong> <?php echo e($contactName); ?></p>
            <p><strong>Correo electrónico:</strong> <a href="mailto:<?php echo e($contactEmail); ?>"><?php echo e($contactEmail); ?></a></p>
            <p><strong>Teléfono:</strong> <?php echo e($contactPhone ?: 'No proporcionado'); ?></p>
            <p><strong>Mensaje:</strong></p>
            <p style="background-color: #f5f5f5; padding: 10px; border-radius: 4px;"><?php echo nl2br(e($contactMessage)); ?></p>
        </div>

        <p style="text-align: center;">
            <a href="<?php echo e(url('/admin/contacts')); ?>" style="display: inline-block; background-color: #b91c1c; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">Ver en el panel de administración</a>
        </p>
    </div>
</body>
</html>