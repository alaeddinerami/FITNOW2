import React, { useEffect } from 'react'
import { Navigate, Outlet,} from 'react-router-dom'
import { useStateContext } from '../context/ContextProvider'
import axios from 'axios'
import axiosClient from '../views/axios-client'
import Users from '../views/Users'

export default function DefaultLayout() {
  const {user,token,setUser,setToken}= useStateContext()

  if(!token){
    return <Navigate to = '/login'/>
  }
    
  useEffect(()=>{
    axiosClient.get('/user')
    .then(({data})=>{
      setUser(data)    
    })
  },[])
  return (
    <div className='layout'>
        {location.pathname === '/' && <Users/>}
        <Outlet/>
    </div>
  )
}
