import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.List;
import java.util.ArrayList;

public class Municipios {
    public static void main(String[] args) {
        String pathcsv = "viviendas-por-intensidad-de-uso-a-partir-del-consumo-electrico.-mediana-consumo-anual.csv";
        String linea;
        String delimitador = ";";

        List<String[]> lista = new ArrayList<>();

        try (BufferedReader br = new BufferedReader(new FileReader(pathcsv))) {

            br.readLine();

            while ((linea = br.readLine()) != null) {
                String[] values = linea.split(delimitador);
                if (values.length > 4) {
                    String territorio = values[3].trim();
                    String valorStr = values[4].trim();

                    try {
                            double valor = Double.parseDouble(valorStr);
                            lista.add(new String[]{territorio, valorStr});
                        } catch (NumberFormatException e) {
                            
                        }
                }
            }
        } catch (IOException e) {
            System.err.println(e.getMessage());
        }

        lista.sort((a, b) -> Double.compare(Double.parseDouble(b[1]), Double.parseDouble(a[1])));
        System.out.println("Medianas más altas:");
        for (int i = 0; i < Math.min(3, lista.size()); i++) {
            String[] municipio = lista.get(i);
            System.out.println((i+1) + ". " + municipio[0] + " - " + municipio[1]);
        }
    }
}
