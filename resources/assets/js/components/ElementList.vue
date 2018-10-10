 <template>
    <div>
        <input type="text" v-model="newElement">
        <button @click="addElement">Ajouter un élément</button>

        <ul>
            <li v-for="element in elements" v-text="element"></li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                elements: [],
                newElement: ''
            };
        },

        created() {
            axios.get('/elements').then(response => (this.elements = response.data));

            window.Echo.private('elements').listen('ElementCreated', e => {
                this.elements.push(e.element.details);
            })
        },

        methods: {
            addElement() {
                axios.post('/elements', { details : this.newElement });

                this.elements.push(this.newElement);

                this.newElement = '';
            }
        }
    }
</script>
