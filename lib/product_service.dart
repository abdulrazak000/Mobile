import 'dart:convert';
import 'package:http/http.dart' as http;
import 'product.dart';

class ProductService {
  static const String baseUrl =
      "https://web-production-3c4af.up.railway.app";

  Future<List<Product>> getProducts() async {
    try {
      final res = await http.get(
        Uri.parse("$baseUrl/get_products.php"),
      );

      print("STATUS: ${res.statusCode}");
      print("BODY: ${res.body}");

      if (res.statusCode == 200) {
        final decoded = jsonDecode(res.body);


        final List data = decoded["data"];

        return data.map((e) => Product.fromJson(e)).toList();
      } else {
        throw Exception("Server error");
      }
    } catch (e) {
      print("GET PRODUCTS ERROR: $e");
      return [];
    }
  }

  Future<bool> addProduct(
      String name, double price, double discount, double tax) async {
    try {
      final res = await http.post(
        Uri.parse("$baseUrl/add_product.php"),
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({
          "name": name,
          "price": price,
          "discount": discount,
          "tax": tax,
        }),
      );

      print("ADD STATUS: ${res.statusCode}");
      print("ADD BODY: ${res.body}");

      if (res.statusCode == 200) {
        final data = jsonDecode(res.body);
        return data["success"] == true;
      }
      return false;
    } catch (e) {
      print("ADD PRODUCT ERROR: $e");
      return false;
    }
  }

  Future<bool> deleteProduct(String id) async {
    try {
      final res = await http.post(
        Uri.parse("$baseUrl/delete_product.php"),
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({"id": id}),
      );

      print("DELETE STATUS: ${res.statusCode}");
      print("DELETE BODY: ${res.body}");

      if (res.statusCode == 200) {
        final data = jsonDecode(res.body);
        return data["success"] == true;
      }
      return false;
    } catch (e) {
      print("DELETE ERROR: $e");
      return false;
    }
  }
}
