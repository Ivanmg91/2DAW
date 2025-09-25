export class PuntoServicio {
  constructor(data) {
    this.direccion = data.address;
    this.numero = data.number;
    this.abierto = data.open;
    this.disponibles = data.available;
    this.libres = data.free;
    this.total = data.total;
    this.ticket = data.ticket;
    this.actualizado = data.updated_at;
    this.geo_point_2d = data.geo_point_2d.lat;
    this.geo_point_2d = data.geo_point_2d.lon;
  }
}