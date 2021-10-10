import {
    extend
} from 'vee-validate';
import {
    email,
    required,
    numeric,
    image,
    alpha_dash
} from 'vee-validate/dist/rules';

export default {
    max: extend('max', {
        validate(value, args) {
            return value.length <= args.length;
        },
        params: ['length'],
        message: 'Trường này yêu cầu tối đa {length} kí tự',
    }),
    min: extend('min', {
        validate(value, args) {
            return value.length >= args.length; 
        },
        params: ['length'],
        message: 'Trường này yêu cầu tối thiểu {length} kí tự',
    }),
    required: extend('required', {
        ...required,
        message: 'Trường này không được bỏ trống'
    }),
    quantityValid: extend('quantityValid', {
        validate(value) {
            return value >= 1;
        },
        message: 'Yêu cầu giá trị lớn hơn 1'
    }),
    one_of: extend('one_of', {
        validate(value, values) {
            return values.indexOf(value) !== -1;
        },
        message: 'Gía trị được chọn không chính xác'
    }),
    email: extend('email', {
        ...email,
        message: 'Trường này phải là một email'
    }),
    numeric: extend('numeric', {
        ...numeric,
        message: 'Trường này yêu cầu một dãy số'
    }),
    image: extend('image', {
        ...image,
        message: 'Tệp tải lên phải là 1 hình ảnh'
    }),
    alpha_dash: extend('alpha_dash', {
        ...alpha_dash,
        message: 'Trường này không được nhập các kí tự đặc biệt'
    }),
}
