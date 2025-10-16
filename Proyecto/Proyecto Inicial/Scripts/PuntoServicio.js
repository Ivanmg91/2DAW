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
    // Guardar geo_point_2d como objeto con lat y lon
    this.geo_point_2d = {
      lat: data.geo_point_2d.lat,
      lon: data.geo_point_2d.lon,
    };
  }
}
