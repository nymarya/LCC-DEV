<template>
    <div>
        <slot :data="data" :errors="errors" :current="current" :add="add" :remove="remove"></slot>
        <template v-for="(object, index) in data">
            <input type="hidden" :name="name + '[' + index + '][' + key + ']'" :value="value" v-for="(value, key) in object">
        </template>
    </div>
</template>

<script>
    export default {
        props: {
            errors: {type: Array},
            old: {type: Array},
            name: {type: String},
            skeleton: {type: Object}
        },
        methods: {
            add: function () {
                this.data.push(this.current);
                this.current = Object.assign({}, this.skeleton);
            },
            remove: function(index) {
                this.data.splice(index, 1);
                this.errors = [];
            }
        },
        data() {
            return {
                data: this.old || [],
                current: Object.assign({}, this.skeleton)
            };
        }
    }
</script>
