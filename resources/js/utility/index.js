
import dayjs from 'dayjs'
import 'dayjs/locale/pt-br'
dayjs.locale('pt-br');


function validar(id) {

    var form = document.getElementById(id)

    if (!form.checkValidity()) {
        form.classList.add('was-validated')
        //toastAlert({ status: 'error', text: 'Verifique os campos obrigatórios!' })
        return false
    }

    return true
}


function deleteByIndex(item, i) {
    item.splice(i, 1);
}

function deleteById(data, id) {
    const objWithIdIndex = data.findIndex((obj) => obj.id === id);

    if (objWithIdIndex > -1) {
        data.splice(objWithIdIndex, 1);
    }
}

function slug(text) {
    var slug = text.normalize("NFD").replace(/[\u0300-\u036f]/gi, "");

    if (slug.search(/[^a-z0-9]/i) != -1) {
        slug = slug.replace(/[^a-z0-9]/gi, "-");
    }
    if (slug.search(/\s/g) != -1) {
        slug = slug.replace(/\s/g, "-");
    }

    return slug.toLowerCase();
}

function date(date = 'now', format = "YYYY-MM-DD HH:mm:ss") {
    if (date) {
        if (date == 'now') { return dayjs().format(format) }
        return dayjs(date).format(format)
    }
    return null
}

function formatter(value) {
    return value.replace(/([0-9]{2})$/g, ",");
}

function parser(value) {
    return value.replace(/\$\s?/g, '');
}

export default {
    validar: validar,
    slug: slug,
    date: date,
    dayjs: dayjs,
    deleteByIndex: deleteByIndex,
    deleteById: deleteById,
    formatter: formatter,
    parser: parser
}
