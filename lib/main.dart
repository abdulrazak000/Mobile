import 'package:flutter/material.dart';
import 'product_list_page.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Discount Calculator',
      theme: ThemeData(primarySwatch: Colors.blue),
      home: CalculatorPage(),
    );
  }
}

class CalculatorPage extends StatefulWidget {
  @override
  _CalculatorPageState createState() => _CalculatorPageState();
}

class _CalculatorPageState extends State<CalculatorPage> {
  final TextEditingController priceController = TextEditingController();
  final TextEditingController discountController = TextEditingController();
  final TextEditingController taxController = TextEditingController();

  double finalPrice = 0.0;
  double savedAmount = 0.0;

  void calculatePrice() {
    final price = double.tryParse(priceController.text.trim()) ?? 0;
    final discount = double.tryParse(discountController.text.trim()) ?? 0;
    final tax = double.tryParse(taxController.text.trim()) ?? 0;

    final priceAfterDiscount = price - (price * discount / 100);
    final taxAmount = priceAfterDiscount * tax / 100;

    setState(() {
      finalPrice = priceAfterDiscount + taxAmount;
      savedAmount = price * discount / 100;
    });
  }

  void clearAll() {
    priceController.clear();
    discountController.clear();
    taxController.clear();
    setState(() {
      finalPrice = 0.0;
      savedAmount = 0.0;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Discount & Tax Calculator')),
      body: SingleChildScrollView(
        padding: EdgeInsets.all(20),
        child: Column(
          children: [
            Icon(Icons.shopping_cart, size: 80, color: Colors.blue),
            SizedBox(height: 30),
            TextField(
              controller: priceController,
              keyboardType: TextInputType.number,
              decoration: InputDecoration(
                labelText: 'Original Price (\$)',
                border: OutlineInputBorder(),
                prefixIcon: Icon(Icons.attach_money),
              ),
            ),
            SizedBox(height: 15),
            TextField(
              controller: discountController,
              keyboardType: TextInputType.number,
              decoration: InputDecoration(
                labelText: 'Discount (%)',
                border: OutlineInputBorder(),
                prefixIcon: Icon(Icons.local_offer),
              ),
            ),
            SizedBox(height: 15),
            TextField(
              controller: taxController,
              keyboardType: TextInputType.number,
              decoration: InputDecoration(
                labelText: 'Tax (%)',
                border: OutlineInputBorder(),
                prefixIcon: Icon(Icons.receipt),
              ),
            ),
            SizedBox(height: 25),
            Row(
              children: [
                Expanded(
                  child: ElevatedButton(
                    onPressed: calculatePrice,
                    child: Text('Calculate'),
                  ),
                ),
                SizedBox(width: 10),
                Expanded(
                  child: OutlinedButton(
                    onPressed: clearAll,
                    child: Text('Clear'),
                  ),
                ),
              ],
            ),
            SizedBox(height: 30),
            Card(
              elevation: 5,
              child: Padding(
                padding: EdgeInsets.all(20),
                child: Column(
                  children: [
                    Text('Results', style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold)),
                    Divider(height: 30),
                    ResultRow(label: 'You Save:', value: '\$${savedAmount.toStringAsFixed(2)}', color: Colors.green),
                    SizedBox(height: 10),
                    ResultRow(label: 'Final Price:', value: '\$${finalPrice.toStringAsFixed(2)}', color: Colors.blue),
                    SizedBox(height: 20),
                    ElevatedButton(
                      onPressed: () {
                        Navigator.push(context, MaterialPageRoute(builder: (_) => ProductListPage()));
                      },
                      child: Text('Go to Products'),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class ResultRow extends StatelessWidget {
  final String label;
  final String value;
  final Color color;

  const ResultRow({required this.label, required this.value, required this.color});

  @override
  Widget build(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(label, style: TextStyle(fontSize: 18)),
        Text(value, style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: color)),
      ],
    );
  }
}