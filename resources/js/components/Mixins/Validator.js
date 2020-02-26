export default {
    data() {
        return {
            rules: {
                required: v => !!v || 'This attribute is required.',
                integer: v => {
                    var re = /[^0-9]/g;
                    if(re.exec(v ? v : '')){
                        return "This attribute must be an integer";
                    }
                    return true;
                },
                realNumber: v => {
                    var re = /^[-]?[0-9]+([.][0-9]{1,10})?$/;
                    if(!re.exec(v ? v : '0')){
                        return "The attribute must be a real number";
                    }
                    return true;
                },
                latitude: v => {
                    if(v > 90 || v < -90){
                        return 'This attribute must be in a range between -90 and 90';
                    }
                    return true;
                },
                longitude: v => {
                    if(v > 180 || v < -180){
                        return 'This attribute must be in a range between -180 and 180';
                    }
                    return true;
                },
                jsonKey: v => {
                    var re = /^[a-zA-Z0-9\-\_]*$/;
                    if(!re.exec(v ? v : '0')){
                        return "This attribute is not a valid json key";
                    }
                    return true;
                }

            }
        }
    }
};