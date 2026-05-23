/**
 * Script de autenticação com animações e interatividade
 */

document.addEventListener('DOMContentLoaded', function () {
    // Animações de entrada para elementos
    animateOnLoad();

    // Validação de formulário em tempo real
    setupFormValidation();

    // Efeitos visuais nos inputs
    setupInputEffects();

    // Validação de força de senha
    setupPasswordStrength();

    // Feedback visual no submit
    setupFormSubmitFeedback();
});

/**
 * Animar elementos ao carregar
 */
function animateOnLoad() {
    const elements = document.querySelectorAll('.form-group, .auth-botao, .auth-divisor');
    
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(10px)';
        el.style.transition = 'all 0.6s ease-out';
        el.style.transitionDelay = (index * 0.05) + 's';
        
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 50);
    });
}

/**
 * Validação de formulário em tempo real
 */
function setupFormValidation() {
    const form = document.querySelector('.auth-form');
    if (!form) return;

    const inputs = form.querySelectorAll('input, textarea');

    inputs.forEach(input => {
        input.addEventListener('blur', function () {
            validateField(this);
        });

        input.addEventListener('input', function () {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
}

/**
 * Validar campo individual
 */
function validateField(field) {
    // Remove classes anteriores
    field.classList.remove('is-invalid', 'is-valid');

    if (!field.value.trim()) {
        return;
    }

    let isValid = true;
    let errorMessage = '';

    // Validações específicas por tipo
    switch (field.type) {
        case 'email':
            isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value);
            errorMessage = 'Email inválido';
            break;
        case 'password':
            isValid = field.value.length >= 6;
            errorMessage = 'Mínimo 6 caracteres';
            break;
        case 'tel':
        case 'text':
            if (field.id === 'cpf') {
                isValid = validateCPF(field.value);
                errorMessage = 'CPF inválido';
            } else if (field.id === 'telefone') {
                isValid = /^\d{10,11}$/.test(field.value.replace(/\D/g, ''));
                errorMessage = 'Telefone inválido';
            } else {
                isValid = field.value.trim().length >= 3;
                errorMessage = 'Campo inválido';
            }
            break;
        case 'textarea':
            if (field.id === 'endereco') {
                isValid = field.value.trim().length >= 5;
                errorMessage = 'Endereço inválido';
            }
            break;
    }

    if (isValid) {
        field.classList.add('is-valid');
    } else {
        field.classList.add('is-invalid');
    }
}

/**
 * Validar CPF
 */
function validateCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false;

    let sum = 0;
    let remainder;

    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;

    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(10, 11))) return false;

    return true;
}

/**
 * Efeitos visuais nos inputs
 */
function setupInputEffects() {
    const inputs = document.querySelectorAll('.form-control');

    inputs.forEach(input => {
        // Efeito ao focar
        input.addEventListener('focus', function () {
            this.parentElement.classList.add('focused');
        });

        // Remover efeito ao desfocar
        input.addEventListener('blur', function () {
            this.parentElement.classList.remove('focused');
        });

        // Efeito visual com valor preenchido
        input.addEventListener('input', function () {
            if (this.value) {
                this.parentElement.classList.add('has-value');
            } else {
                this.parentElement.classList.remove('has-value');
            }
        });
    });
}

/**
 * Validação de força de senha
 */
function setupPasswordStrength() {
    const passwordInput = document.getElementById('password');
    if (!passwordInput) return;

    let strengthMeter = document.getElementById('password-strength');
    if (!strengthMeter) {
        strengthMeter = document.createElement('div');
        strengthMeter.id = 'password-strength';
        strengthMeter.style.cssText = 'height: 3px; background: transparent; margin-top: 6px; border-radius: 2px; transition: all 0.3s ease;';
        passwordInput.parentElement.appendChild(strengthMeter);
    }

    passwordInput.addEventListener('input', function () {
        const strength = calculatePasswordStrength(this.value);
        updateStrengthMeter(strengthMeter, strength);
    });
}

/**
 * Calcular força da senha
 */
function calculatePasswordStrength(password) {
    let strength = 0;

    if (password.length >= 6) strength++;
    if (password.length >= 10) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;

    return Math.min(strength, 4);
}

/**
 * Atualizar medidor de força de senha
 */
function updateStrengthMeter(meter, strength) {
    const colors = ['#e05c5c', '#e8b94c', '#e8c97a', '#6ec98a'];
    const labels = ['Fraca', 'Média', 'Boa', 'Forte'];

    meter.style.background = colors[strength - 1] || 'transparent';
    meter.style.width = (strength * 25) + '%';

    if (strength > 0) {
        meter.title = 'Força: ' + labels[strength - 1];
    }
}

/**
 * Feedback visual no submit do formulário
 */
function setupFormSubmitFeedback() {
    const form = document.querySelector('.auth-form');
    if (!form) return;

    const submitButton = form.querySelector('.auth-botao');
    if (!submitButton) return;

    form.addEventListener('submit', function (e) {
        // Validar todos os campos obrigatórios
        const inputs = this.querySelectorAll('input[required], textarea[required]');
        let hasErrors = false;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                hasErrors = true;
                input.classList.add('is-invalid');
            }
        });

        if (!hasErrors) {
            // Adicionar classe de loading
            submitButton.classList.add('loading');
            submitButton.disabled = true;

            // Simular carregamento com ícone giratório
            const icon = submitButton.querySelector('i');
            if (icon) {
                icon.style.animation = 'spin 1s linear infinite';
            }
        } else {
            e.preventDefault();
            // Shake animation
            this.style.animation = 'shake 0.3s ease';
            setTimeout(() => {
                this.style.animation = '';
            }, 300);
        }
    });
}

// Animação de shake para erro
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .form-group.focused .form-control {
        border-color: rgba(201, 168, 76, 0.62);
    }

    .form-group.has-value .form-label {
        color: var(--auth-ouro, #c9a84c);
    }
`;
document.head.appendChild(style);
