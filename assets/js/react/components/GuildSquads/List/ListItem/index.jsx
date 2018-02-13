import React from 'react'
import { Link } from 'react-router-dom'
import FontAwesome from 'react-fontawesome'

const ListItem = ({ item }) => (
  <div className={'list-group-item'}>
    <div className="row">
      <div className="col-10">
        {item.name}
      </div>
      <div className="col-2 text-right">
        <Link className={'btn btn-danger btn-sm mr-2'} title={'Build squad'} to={`/guild-squads/${item.id}/builder`}>
          <FontAwesome name={'users'} />
        </Link>
        <Link className={'btn btn-info btn-sm'} title={'Edit name'} to={`/guild-squads/${item.id}`}>
          <FontAwesome name={'pencil'} />
        </Link>
      </div>
    </div>
  </div>
    )

export default ListItem
