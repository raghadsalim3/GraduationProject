import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:web/Featuers/auth/Application/auth_bloc.dart';
import 'package:web/enjection.dart.dart';
import 'package:web/Featuers/auth/Presentation/login_screen.dart';
import 'package:get_it/get_it.dart';

void main() {
  setup(useMock: true);
  runApp(const MyApp());

  //final authBloc = getIt<AuthBloc>();
  //authBloc.add(LoginEvent(username: 'test', password: '123'));
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: BlocProvider<AuthBloc>(
        create: (context) =>
            GetIt.instance<AuthBloc>(), // تأكد من أن getIt معرّفة
        child: BlocBuilder<AuthBloc, AuthState>(
          builder: (context, state) {
            if (state is AuthSuccess) {
              return const HomeScreen();
            }
            return LoginScreen();
          },
        ),
      ),
      routes: {
        '/home': (context) => const HomeScreen(),
      },
    );
  }
}
