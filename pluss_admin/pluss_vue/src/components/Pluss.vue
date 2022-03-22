<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>id</th>
          <th>Név</th>
          <th>Művelet</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pluss in plussok" v-bind:key="pluss.id">
          <td>{{ pluss.id }}</td>
          <td>{{ pluss.name }}</td>
          <td>
            <button @click="editpluss(pluss.id)">Szerkesztés</button>
            <button @click="deletepluss(pluss.id)">Törlés</button>
          </td>
        </tr>
        <tr>
          <td>
            <input type="hidden" v-model="pluss.id">
          </td>
          <td>
            <input type="text" v-model="pluss.name">
          </td>
          <td>
            <button v-if="mod_new" @click="newpluss" :disabled="saving">Létrehoz</button>
            <button v-if="!mod_new" @click="savepluss" :disabled="saving">Mentés</button>
            <button v-if="!mod_new" @click="cancelpluss" :disabled="saving">Mégse</button>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="loadData">Betöltés</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mod_new: true, 
      saving: false,
      pluss: {
        id: null,
        name: ''
      },
      plussok: []
    }
  },
  methods: {
    async loadData () {
     let Response = await fetch('http://127.0.0.1:8000/api/plussok')
     let data = await Response.json()
     this.plussok = data
    },
    async deletepluss(id) {
      let Response = await fetch(`http://127.0.0.1:8000/api/plussok/${id}`, {
        method: 'DELETE'
      })
      console.log(Response)
      await this.loadData()
    },
    async newpluss() {
      this.saving='disabled'
     await fetch('http://127.0.0.1:8000/api/plussok', {
       method: 'POST',
       headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
       },
       body: JSON.stringify(this.pluss) 
     })
     await this.loadData()
     this.saving=false
     this.resetForm()
    },
    async savepluss() {
      this.saving='disabled'
     await fetch(`http://127.0.0.1:8000/api/plussok/${this.pluss.id}`, {
       method: 'PATCH',
       headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
       },
       body: JSON.stringify(this.pluss) 
     })
     await this.loadData()
     this.saving=false
     this.resetForm()
    },
    async editpluss(id) {
      let Response = await fetch(`http://127.0.0.1:8000/api/plussok/${id}`)
      let data = await Response.json()
      this.pluss = {...data};
      this.mod_new = false
    },
    cancelEdit () {
      this.resetForm()
    },
    resetForm() {
      this.pluss = {
        id: null,
        name: ''
      }
      this.mod_new = true
    }
  },
  mounted() {
    this.loadData()
  }
}
</script>