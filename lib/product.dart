class Product {
  final String id;
  final String name;
  final double price;
  final double discount;
  final double tax;

  Product({
    required this.id,
    required this.name,
    required this.price,
    required this.discount,
    required this.tax,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'].toString(),
      name: json['name'],
      price: double.parse(json['price'].toString()),
      discount: double.parse(json['discount'].toString()),
      tax: double.parse(json['tax'].toString()),
    );
  }

  double get priceAfterDiscount => price - (price * discount / 100);
  double get finalPrice =>
      priceAfterDiscount + (priceAfterDiscount * tax / 100);
}