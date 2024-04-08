import { Navigate, createBrowserRouter } from "react-router-dom";

import Login from "./views/Login";
import Singup from "./views/Singup";
import Users from "./views/Users";
import NotfoundVwie from "./views/NotfoundView";
import DefaultLayout from "./components/DefaultLayout";
import GuestLayout from "./components/GuestLayout";

const router = createBrowserRouter([
  {
    path: "/",
    element: <DefaultLayout />,
    children: [
      {
        path: "/Users",
        element: <Users />,
      },
    ],
  },
  
  {
    path: "/",
    element: <GuestLayout />,
    children: [
      {
        path: "/login",
        element: <Login />,
      },
      {
        path: "/Singup",
        element: <Singup />,
      },
    ],
  },

  {
    path: "*",
    element: <NotfoundVwie />,
  },
]);

export default router;
