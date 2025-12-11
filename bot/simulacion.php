<?php
class BotSimulador {
    public function hacerLlamadaSimple($telefono, $mensaje) {
        // Return simulated result
        $states = ['completada','fallida'];
        $s = $states[array_rand($states)];
        return ['estado'=>$s, 'respuesta'=>$s === 'completada' ? 'Contacto confirmado' : 'No contestó'];
    }
}
?>