import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Inputmask from "inputmask";

Inputmask({"mask": "999.999.999-99"}).mask(document.querySelectorAll("#cpf"));
Inputmask("(99) 99999-9999").mask("#telefone");
Inputmask("(99) 9999-9999").mask("#telefone_fixo");
Inputmask({"mask": "99.999.999/9999-99"}).mask(document.querySelectorAll("#cnpj"));
Inputmask({"mask": "99.999-999"}).mask(document.querySelectorAll("#cep"));
Inputmask({
    alias: 'currency',
    
    groupSeparator: '.',
    radixPoint: ',',
    autoGroup: true,
    digits: 2,
    digitsOptional: false,
    placeholder: '0',
    rightAlign: true,
    removeMaskOnSubmit: true
}).mask(document.querySelectorAll(".valor-monetario"));