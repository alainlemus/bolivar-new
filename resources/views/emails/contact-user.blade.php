<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje de Confirmación</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #1a1a1a; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
        <?php if ($logoUrl): ?>
            <img src="<?php echo e($logoUrl); ?>" alt="Funeraria García de Bolívar" style="max-height: 80px; max-width: 200px;">
        <?php else: ?>
            <h1 style="margin: 0; font-size: 24px;">Funeraria García de Bolívar</h1>
        <?php endif; ?>
    </div>

    <div style="background-color: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; border: 1px solid #ddd;">
        <h2 style="color: #1a1a1a; margin-top: 0;">Estimado/a <?php echo e($contactName); ?>,</h2>

        <p>Gracias por contactarnos. Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>

        <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #555; font-size: 16px;">Resumen de tu mensaje:</h3>
            <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">
            <p><strong>Nombre:</strong> <?php echo e($contactName); ?></p>
            <p><strong>Correo electrónico:</strong> <?php echo e($contactEmail); ?></p>
            <p><strong>Teléfono:</strong> <?php echo e($contactPhone ?: 'No proporcionado'); ?></p>
            <p><strong>Mensaje:</strong></p>
            <p style="background-color: #f5f5f5; padding: 10px; border-radius: 4px;"><?php echo nl2br(e($contactMessage)); ?></p>
        </div>

        <p>Si necesitas una respuesta urgente, puedes contactarnos directamente por teléfono.</p>

        <p style="margin-top: 30px;">Atentamente,<br><strong>Funeraria García de Bolívar</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px; color: #888; font-size: 12px;">
        <p>Este es un correo automático. Por favor no responda directamente a este mensaje.</p>
    </div>
</body>
</html>