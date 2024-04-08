import React from 'react';
import axiosClient from '../views/axios-client';
import { useStateContext } from '../context/ContextProvider'


const Navbar = () => {
    const {user,token,setUser,setToken}= useStateContext()
    const onLogout =(ev) =>{
        ev.preventDefault()
        axiosClient.post('/logout')
        .then(()=>{
        setUser({})
        setToken(null) })
      }
    
  return (
    <nav className="bg-gray-800 shadow">
      <div className="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="flex-shrink-0">
            <span className="text-white">Logo</span>
          </div>
          <div className="hidden md:block">
            <div className="flex items-center space-x-4">
              <a href="#" className="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">User</a>
              
            <button onClick={onLogout} className="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
