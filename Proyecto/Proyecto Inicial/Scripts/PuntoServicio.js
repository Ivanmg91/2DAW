export class PuntoServicio {
  constructor(data) {
    this.direccion = data.address;
    this.numero = data.number;
    this.abierto = data.open === "T";
    this.disponibles = data.available;
    this.libres = data.free;
    this.total = data.total;
    this.actualizado = data.updated_at;
  }

  generarCardHTML() {
    return `
      <div class="card">
        <h3>${this.direccion}</h3>
        <p><strong>ID:</strong> ${this.numero}</p>
        <p><strong>Estado:</strong> ${this.abierto ? "🟢 Abierto" : "🔴 Cerrado"}</p>
        <p><strong>Disponibles:</strong> ${this.disponibles}</p>
        <p><strong>Libres:</strong> ${this.libres}</p>
        <p><strong>Total:</strong> ${this.total}</p>
        <p><em>Actualizado:</em> ${this.actualizado}</p>
      </div>
    `;
  }
}
