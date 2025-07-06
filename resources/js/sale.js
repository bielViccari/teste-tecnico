document.getElementById('product').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const price = selected.dataset.price;
    document.getElementById('unit_price').value = price;
    calcularTotal();
});

document.getElementById('quantity').addEventListener('input', calcularTotal);
    function calcularTotal() {
        const qtd = parseFloat(document.getElementById('quantity').value);
        const price = parseFloat(document.getElementById('unit_price').value);
        const total = !isNaN(qtd) && !isNaN(price) ? qtd * price : 0;
        document.getElementById('total').value = total.toFixed(2);
    }

document.getElementById('payment').addEventListener('change', function () {
    const parcelamento = document.getElementById('parcelamento');
    parcelamento.classList.toggle('d-none', this.value !== 'Personalizado');
});

document.getElementById('firstQuota').addEventListener('input', calcularParcelas);
document.getElementById('quota_qtd').addEventListener('input', calcularParcelas);
document.getElementById('total').addEventListener('input', calcularParcelas);
document.getElementById('date_payment').addEventListener('change', calcularParcelas);

function calcularParcelas() {
    const total = parseFloat(document.getElementById('total').value);
    const quota_qtd = parseInt(document.getElementById('quota_qtd').value);
    const first = parseFloat(document.getElementById('firstQuota').value);
    const date = document.getElementById('date_payment').value;
    const container = document.getElementById('inputsParcelas');

    container.innerHTML = '';

    if (isNaN(total) || isNaN(quota_qtd) || isNaN(first) || quota_qtd < 1 || first > total || !date) {
        return;
    }

    let restante = total - first;
    const restanteParcelas = quota_qtd - 1;
    const valorRestante = restanteParcelas > 0 ? (restante / restanteParcelas).toFixed(2) : 0;

    let currentDate = new Date(date);

    for (let i = 1; i <= quota_qtd; i++) {
        const valor = i === 1 ? first.toFixed(2) : valorRestante;

        const div = document.createElement('div');
        div.className = 'row mb-2';

        const col1 = document.createElement('div');
        col1.className = 'col-md-6';
        const inputValor = document.createElement('input');
        inputValor.type = 'text';
        inputValor.className = 'form-control';
        inputValor.name = `parcelas[${i}][valor]`;
        inputValor.value = valor;
        col1.appendChild(inputValor);

        const col2 = document.createElement('div');
        col2.className = 'col-md-6';
        const inputData = document.createElement('input');
        inputData.type = 'date';
        inputData.className = 'form-control';
        inputData.name = `parcelas[${i}][data]`;
        inputData.valueAsDate = new Date(currentDate);
        col2.appendChild(inputData);

        div.appendChild(col1);
        div.appendChild(col2);
        container.appendChild(div);

        currentDate.setDate(currentDate.getDate() + 30);
    }
}
