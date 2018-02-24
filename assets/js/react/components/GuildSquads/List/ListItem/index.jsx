import React from 'react'
import { Link } from 'react-router-dom'
import { Redirect } from 'react-router-dom'
import FontAwesome from 'react-fontawesome'
import { Button } from 'react-bootstrap'
import { confirmAlert } from 'react-confirm-alert'
import Item from './Item'

class ListItem extends React.Component {
  removeAction = () => {
    confirmAlert({
      title: 'Confirm to submit',
      message: 'Are you sure you wan\'t to remove this squad?',
      confirmLabel: 'Confirm',
      onConfirm: () => this.props.removeSquad(this.props.item.id),
    })
  };

  render() {
    const { item } = this.props

    return (
      <div className={'card'}>
        <div className={'list-group list-group-flush'}>
          <div className={'card-header'}>
            <h3 className={'pull-left'}>{item.name}</h3>

            <div className="pull-right">
              <Link className={'btn btn-info btn-sm'} title={'Edit name'} to={`/guild-squads/${item.id}`}>
                Edit&nbsp;&nbsp;<FontAwesome name={'pencil'} />
              </Link>
              <Link
                className={'btn btn-primary btn-sm ml-2'} title={'Build squad'}
                to={`/guild-squads/${item.id}/builder`}
              >
                Collection&nbsp;&nbsp;<span
                  className="badge badge-light"
                >{Object.keys(item.guild_squad_collection).length}</span>
              </Link>
              <Button className={'btn btn-danger btn-sm ml-2'} onClick={() => this.removeAction()}>
                Delete <FontAwesome name={'trash'} />
              </Button>
            </div>
          </div>
          <div className="list-group-item">
            {Object.keys(item.guild_squad_collection).length > 0 &&
            <div className={'row'}>
              {item.guild_squad_collection.map(itemCharacter => <Item key={itemCharacter.character.id} item={itemCharacter.character} />)}
            </div>
            }
            {Object.keys(item.guild_squad_collection).length === 0 &&
            <div className={'alert alert-warning mb-0'}>
              Pick your squad! <Link
                className={'btn btn-primary btn-sm ml-2'} title={'Build squad'}
                to={`/guild-squads/${item.id}/builder`}
              >
              HERE
            </Link>
            </div>
            }
          </div>
        </div>
      </div>
    )
  }
}

export default ListItem
