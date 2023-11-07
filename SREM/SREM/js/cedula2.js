function formatoCedula(input) {
    
    const CIInput = document.getElementById('CI');
    
    CIInput.addEventListener('input', function (event) {
        // Eliminar caracteres no permitidos
        const formattedValue = event.target.value.replace(/[^0-9]/g, '');

        // Limitar a 8 caracteres
        const limitedValue = formattedValue.slice(0, 8);

        // Aplicar formato
        const formattedCI = limitedValue.replace(/(\d{1})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3-$4');

        // Actualizar el valor del campo
        event.target.value = formattedCI;
    });



}